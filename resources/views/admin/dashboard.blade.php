@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-warning">Painel Administrativo</h1>

        {{-- CÓDIGO CORRIGIDO PARA O LOGOUT --}}
        <a href="{{ route('logout') }}" class="btn btn-outline-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sair
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        {{-- FIM DA CORREÇÃO --}}
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-5">
        {{-- Gerenciar Produtos --}}
        <div class="col-lg-6">
            <div class="p-4 bg-darker rounded">
                <h3 class="text-warning mb-3">Gerenciar Produtos</h3>
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control bg-dark text-light" placeholder="Nome do Produto" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="description" class="form-control bg-dark text-light" placeholder="Descrição" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="url" name="image_url" class="form-control bg-dark text-light" placeholder="URL da Imagem" required>
                    </div>
                    <div class="mb-3">
                        <select name="type" class="form-select bg-dark text-light" required>
                            <option value="camiseta">Camiseta</option>
                            <option value="produto_barba">Produto de Barba</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">Adicionar Produto</button>
                </form>

                <hr class="my-4 border-secondary">
                <h4 class="h5">Produtos Cadastrados</h4>
                <ul class="list-group">
                    @forelse($products as $product)
                    <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                        </form>
                    </li>
                    @empty
                    <li class="list-group-item bg-dark text-secondary">Nenhum produto.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Gerenciar Horários --}}
        <div class="col-lg-6">
            <div class="p-4 bg-darker rounded">
                <h3 class="text-warning mb-3">Gerenciar Horários</h3>
                <form action="{{ route('admin.slots.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="datetime-local" name="slot_datetime" class="form-control bg-dark text-light" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Adicionar Horário</button>
                </form>

                <hr class="my-4 border-secondary">
                <h4 class="h5">Horários Disponíveis</h4>
                <ul class="list-group">
                    @forelse($slots as $slot)
                    <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                        {{ \Carbon\Carbon::parse($slot->slot_datetime)->format('d/m/Y H:i') }}
                        <form action="{{ route('admin.slots.destroy', $slot) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                        </form>
                    </li>
                    @empty
                    <li class="list-group-item bg-dark text-secondary">Nenhum horário.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
