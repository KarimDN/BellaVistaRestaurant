<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private function systemPrompt()
    {
        return <<<PROMPT
        You are a helpful assistant for Bella Vista restaurant. You can answer questions about the menu and help customers book reservations.

        If the customer asks about the menu or food items, respond ONLY with this exact JSON (nothing else):
        {"action": "get_menu", "category": "all"}
        If the user asks for a specific category like appetizers, desserts, drinks, vegan, mains, starters, etc, respond like:
        {"action": "get_menu", "category": "appetizers"}

        Valid categories include:
        - Starters
        - Mains
        - Desserts
        - Drinks

        If unsure, use "all".

        If the customer wants to book a reservation AND has given you all required details (name, email, phone, date, time, number of guests), respond ONLY with this exact JSON (nothing else):
        {"action": "create_reservation", "customer_name": "...", "customer_email": "...", "customer_phone": "...", "reservation_date": "YYYY-MM-DD", "reservation_time": "HH:MM", "guests": N}

        If the customer wants to book but hasn't given all the details yet, ask them for the missing details in plain text (not JSON).

        For any other question, just answer normally in plain text.
        PROMPT;
    }

    public function respond(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->message;

        $response = Http::withToken(config('services.huggingface.key'))
            ->post('https://router.huggingface.co/v1/chat/completions', [
                'model' => 'deepseek-ai/DeepSeek-V4-Pro:novita',
                'messages' => [
                    ['role' => 'system', 'content' => $this->systemPrompt()],
                    ['role' => 'user', 'content' => $userMessage],
                ],
            ]);

        $data = $response->json();
        $reply = $data['choices'][0]['message']['content'] ?? null;

        if (!$reply) {
            return response()->json(['reply' => 'Sorry, something went wrong.', 'debug' => $data]);
        }

        $parsed = json_decode($reply, true);

        if (is_array($parsed) && isset($parsed['action'])) {
            if ($parsed['action'] === 'get_menu') {

                $query = MenuItem::with('category')
                    ->where('is_available', true);

                $category = $parsed['category'] ?? 'all';

                if ($category !== 'all') {
                    $query->whereHas('category', function ($q) use ($category) {
                        $q->where('name', 'like', '%' . $category . '%');
                    });
                }

                $items = $query->get();

                if ($items->isEmpty()) {
                    return response()->json([
                        'reply' => "Sorry, I couldn't find any {$category} items."
                    ]);
                }

                $menuText = $items->map(function ($i) {
                    return "{$i->name} (\${$i->price}): {$i->description}";
                })->join("\n");

                return response()->json([
                    'reply' => "Here are our " . ($category === 'all' ? 'menu' : $category) . " options:\n\n" . $menuText
                ]);
            }

            if ($parsed['action'] === 'create_reservation') {
                $reservation = Reservation::create([
                    'customer_name' => $parsed['customer_name'],
                    'customer_email' => $parsed['customer_email'],
                    'customer_phone' => $parsed['customer_phone'],
                    'reservation_date' => $parsed['reservation_date'],
                    'reservation_time' => $parsed['reservation_time'],
                    'guests' => $parsed['guests'],
                    'status' => 'pending',
                ]);

                return response()->json(['reply' => "Great, your reservation for {$parsed['guests']} guests on {$parsed['reservation_date']} at {$parsed['reservation_time']} has been booked! We'll confirm shortly."]);
            }
        }

        return response()->json(['reply' => $reply]);
    }
}