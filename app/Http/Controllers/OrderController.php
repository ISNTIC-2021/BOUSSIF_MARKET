<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function generatePDF(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $orders = Order::query();

    if ($startDate && $endDate) {
        $orders->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
    }

    $orders = $orders->get();

    // Load the HTML template view
    $html = view('orders.orders', compact('orders', 'startDate', 'endDate'))->render();

    // Generate the PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation if needed
    $dompdf->render();

    // Output the generated PDF
    return $dompdf->stream('orders.pdf');
}

    
    public function generateReceipt(Order $order)
    {
        // Retrieve necessary data for the receipt
        $data = [
            'order' => $order,
        ];

        // Load the receipt template view
        $view = view('receipt', $data);

        // Instantiate a new Dompdf instance
        $dompdf = new Dompdf();

        // Set the HTML content for the PDF
        $dompdf->loadHtml($view->render());

        // (Optional) Adjust Dompdf configuration settings if needed
        // For example:
        // $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Output the PDF as a response
        return $dompdf->stream('receipt.pdf');
    }

    public function showInvoice()
    {
        $orders = Order::all(); // Replace this with your actual logic to fetch the orders
    
        $total = 0; // Replace with your actual logic to calculate the total
        $receivedAmount = 0; // Replace with your actual logic to calculate the received amount
    
        return view('receipt', compact('orders', 'total', 'receivedAmount'));
    }

    public function index(Request $request)
    {
        $orders = new Order();

        if ($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);

        return 'success';
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($id);

        // Update the status
        $order->status = $request->status;
        $order->save();

        // Return a response indicating success
        return response()->json(['message' => 'Status updated successfully']);
    }
}
