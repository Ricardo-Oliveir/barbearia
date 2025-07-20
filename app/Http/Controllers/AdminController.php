<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\GenerateSlotsRequest;
use App\Models\Product;
use App\Models\AvailableSlot;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::latest()->get();
        $slots = AvailableSlot::with('appointment')->orderBy('slot_datetime', 'asc')->get();
        $appointments = Appointment::with('availableSlot')->latest()->get();

        return view('admin.dashboard', compact('products', 'slots', 'appointments'));
    }

    public function storeProduct(StoreProductRequest $request)
    {
        Product::create($request->validated());

        return back()->with('success', 'Produto adicionado com sucesso!');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produto removido com sucesso!');
    }

    // NOVA FUNÇÃO PARA GERAR HORÁRIOS
    public function generateSlots(GenerateSlotsRequest $request)
    {
        $validated = $request->validated();
        $start = Carbon::parse($validated['date'] . ' ' . $validated['start_time']);
        $end = Carbon::parse($validated['date'] . ' ' . $validated['end_time']);
        $interval = $validated['interval'];

        $period = CarbonPeriod::create($start, "{$interval} minutes", $end);

        foreach ($period as $datetime) {
            // Não cria o último horário se ele coincidir com a hora de fim
            if ($datetime->format('H:i') === $end->format('H:i')) {
                continue;
            }

            AvailableSlot::updateOrCreate([
                'slot_datetime' => $datetime->toDateTimeString()
            ]);
        }

        return back()->with('success', 'Horários gerados com sucesso!');
    }

    public function destroySlot(AvailableSlot $slot)
    {
        $slot->delete();
        return back()->with('success', 'Horário removido com sucesso!');
    }
}
