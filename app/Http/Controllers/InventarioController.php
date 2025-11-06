<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\MovimientoInventario;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('nombre')->get();
        $movimientos = MovimientoInventario::with('producto')->orderBy('fecha', 'desc')->get();
        return view('Dashboard.Almacenista', compact('productos', 'movimientos'));
    }

    public function registrarMovimiento(Request $request)
    {
        $request->validate([
            'producto_nombre' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $producto = Producto::firstOrCreate(
            ['nombre' => $request->producto_nombre],
            [
                'categoria' => $request->categoria,
                'precio' => $request->precio ?? 0,
                'cantidad' => 0,
                'fecha_registro' => now(),
                'Usuario_id_usuario' => Auth::id() ?? 1,
            ]
        );

        if ($request->filled('precio') && $producto->precio != $request->precio)
            $producto->precio = $request->precio;

        if ($request->filled('categoria') && $producto->categoria != $request->categoria)
            $producto->categoria = $request->categoria;

        
        if ($request->tipo === 'entrada') {
            $producto->cantidad += $request->cantidad;
        } else {
            if ($producto->cantidad < $request->cantidad) {
                return back()->with('error', 'No hay suficiente stock disponible.');
            }
            $producto->cantidad -= $request->cantidad;
        }

        $producto->save();

        MovimientoInventario::create([
            'id_producto' => $producto->id_producto,
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion ?? null,
            'Usuario_id_usuario' => Auth::id() ?? 1,
            'fecha' => now(),
        ]);

        return redirect()->route('inventario.index')->with('success', 'Movimiento registrado correctamente.');
    }

    public function editar($id)
    {
        $movimiento = MovimientoInventario::with('producto')->findOrFail($id);
        return view('Dashboard.EditarMovimiento', compact('movimiento'));
    }

    public function actualizar(Request $request, $id)
    {
        $movimiento = MovimientoInventario::findOrFail($id);
        $producto = Producto::findOrFail($movimiento->id_producto);

        $request->validate([
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string|max:255',
        ]);

        if ($movimiento->tipo === 'entrada') {
            $producto->cantidad -= $movimiento->cantidad;
        } else {
            $producto->cantidad += $movimiento->cantidad;
        }

        if ($request->tipo === 'entrada') {
            $producto->cantidad += $request->cantidad;
        } else {
            if ($producto->cantidad < $request->cantidad) {
                return back()->with('error', 'No hay suficiente stock para actualizar.');
            }
            $producto->cantidad -= $request->cantidad;
        }

        $producto->save();

        $movimiento->update([
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('inventario.index')->with('success', 'Movimiento actualizado correctamente.');
    }
public function eliminar($id)
{
    $movimiento = MovimientoInventario::findOrFail($id);
    $producto = Producto::findOrFail($movimiento->id_producto);

    
    if ($movimiento->tipo === 'entrada') {
        $producto->cantidad -= $movimiento->cantidad;
    } else {
        $producto->cantidad += $movimiento->cantidad;
    }

    $producto->save();

    $movimiento->delete();

    if ($producto->cantidad <= 0) {
        $producto->delete();
    }

    return redirect()->route('inventario.index')->with('success', 'Movimiento y producto eliminados correctamente.');
}
}