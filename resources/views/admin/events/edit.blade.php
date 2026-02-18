@extends('layouts.app')

@section('title', 'Editar Evento - Admin')

@section('content')

<div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.eventos.show', $event) }}" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold">Editar: {{ $event->title }}</h1>
        </div>
    </div>
</div>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="{{ route('admin.eventos.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Informações Básicas -->
            <div class="card">
                <h3 class="text-xl font-bold mb-6">Informações Básicas</h3>
                
                <div class="space-y-6">
                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Título do Evento *
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $event->title) }}"
                            class="input @error('title') !border-red-500 @enderror"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Slug (URL amigável)
                        </label>
                        <input 
                            type="text" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug', $event->slug) }}"
                            class="input @error('slug') !border-red-500 @enderror"
                            placeholder="retiro-de-carnaval-2026"
                        >
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">URL: {{ url('/eventos') }}/{{ old('slug', $event->slug) }}</p>
                    </div>
                    
                    <!-- Descrição -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Descrição *
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="6"
                            class="input @error('description') !border-red-500 @enderror"
                            required
                        >{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Instruções -->
                    <div>
                        <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                            Instruções para os Participantes
                            <span class="text-gray-500 text-xs">(o que levar, horário de chegada, etc.)</span>
                        </label>
                        <textarea 
                            id="instructions" 
                            name="instructions" 
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >{{ old('instructions', $event->instructions) }}</textarea>
                    </div>
                    
                    <!-- Imagem do Evento -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem do Evento
                            <span class="text-gray-500 text-xs">(JPEG, PNG, WebP – máx. 5 MB)</span>
                        </label>

                        @if($event->cover_url && !old('remove_image'))
                            <!-- Imagem atual -->
                            <div id="current-image-wrap" class="mb-3">
                                <img src="{{ $event->cover_url }}" alt="{{ $event->title }}"
                                     id="current-img"
                                     class="rounded-lg max-h-48 w-full object-cover">
                                <label class="inline-flex items-center gap-2 mt-2 text-sm text-red-600 cursor-pointer">
                                    <input type="checkbox" name="remove_image" value="1"
                                           onchange="toggleRemoveImage(this)">
                                    Remover imagem atual
                                </label>
                            </div>
                        @endif

                        <!-- Drop zone -->
                        <div id="drop-zone"
                             class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-primary-400 transition-colors bg-gray-50 hover:bg-primary-50/30 {{ $event->cover_url ? 'hidden' : '' }}"
                             onclick="document.getElementById('image').click()">
                            <div id="drop-placeholder" class="flex flex-col items-center gap-2 text-gray-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4-4m0 0l4-4m-4 4h12M4 12V6a2 2 0 012-2h12a2 2 0 012 2v6"/>
                                    <rect x="2" y="14" width="20" height="6" rx="2"/>
                                </svg>
                                <span class="text-sm font-medium">Clique ou arraste uma imagem aqui</span>
                                <span class="text-xs">JPEG · PNG · WebP · GIF</span>
                            </div>
                            <img id="image-preview" src="" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-lg">
                        </div>

                        <input type="file" id="image" name="image"
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               class="hidden"
                               onchange="previewImage(this)">

                        @if($event->cover_url)
                            <p class="text-xs text-gray-500 mt-1">Selecione um novo arquivo para substituir a imagem atual.</p>
                        @endif

                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Data e Local -->
            <div class="card">
                <h3 class="text-xl font-bold mb-6">Data e Local</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data de Início -->
                    <div>
                        <label for="start_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Data e Hora de Início *
                        </label>
                        <input 
                            type="datetime-local" 
                            id="start_at" 
                            name="start_at" 
                            value="{{ old('start_at', $event->start_at->format('Y-m-d\TH:i')) }}"
                            class="input @error('start_at') !border-red-500 @enderror"
                            required
                        >
                        @error('start_at')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Data de Término -->
                    <div>
                        <label for="end_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Data e Hora de Término
                        </label>
                        <input 
                            type="datetime-local" 
                            id="end_at" 
                            name="end_at" 
                            value="{{ old('end_at', $event->end_at ? $event->end_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>
                    
                    <!-- Nome do Local -->
                    <div>
                        <label for="location_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome do Local *
                        </label>
                        <input 
                            type="text" 
                            id="location_name" 
                            name="location_name" 
                            value="{{ old('location_name', $event->location_name) }}"
                            class="input @error('location_name') !border-red-500 @enderror"
                            placeholder="Sítio Esperança"
                            required
                        >
                        @error('location_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Endereço -->
                    <div>
                        <label for="location_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Endereço Completo
                        </label>
                        <input 
                            type="text" 
                            id="location_address" 
                            name="location_address" 
                            value="{{ old('location_address', $event->location_address) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="Rua Exemplo, 123 - Garanhuns/PE"
                        >
                    </div>
                </div>
            </div>
            
            <!-- Inscrições e Vagas -->
            <div class="card">
                <h3 class="text-xl font-bold mb-6">Inscrições e Vagas</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Capacidade -->
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">
                            Capacidade (Número de Vagas)
                            <span class="text-gray-500 text-xs">(deixe vazio para ilimitado)</span>
                        </label>
                        <input 
                            type="number" 
                            id="capacity" 
                            name="capacity" 
                            value="{{ old('capacity', $event->capacity) }}"
                            min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="50"
                        >
                        @if($event->capacity)
                        <p class="text-xs text-gray-500 mt-1">
                            Atual: {{ $event->registrations()->count() }} / {{ $event->capacity }} vagas ocupadas
                        </p>
                        @endif
                    </div>
                    
                    <!-- Preço -->
                    <div>
                        <label for="price_cents" class="block text-sm font-medium text-gray-700 mb-2">
                            Preço (em centavos) *
                            <span class="text-gray-500 text-xs">(0 para gratuito, 5000 para R$ 50,00)</span>
                        </label>
                        <input 
                            type="number" 
                            id="price_cents" 
                            name="price_cents" 
                            value="{{ old('price_cents', $event->price_cents) }}"
                            min="0"
                            class="input @error('price_cents') !border-red-500 @enderror"
                            required
                        >
                        @error('price_cents')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">
                            Atual: {{ $event->priceFormatted() }}
                        </p>
                    </div>
                    
                    <!-- Abertura das Inscrições -->
                    <div>
                        <label for="registration_open_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Abertura das Inscrições
                        </label>
                        <input 
                            type="datetime-local" 
                            id="registration_open_at" 
                            name="registration_open_at" 
                            value="{{ old('registration_open_at', $event->registration_open_at ? $event->registration_open_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>
                    
                    <!-- Fechamento das Inscrições -->
                    <div>
                        <label for="registration_close_at" class="block text-sm font-medium text-gray-700 mb-2">
                            Fechamento das Inscrições
                        </label>
                        <input 
                            type="datetime-local" 
                            id="registration_close_at" 
                            name="registration_close_at" 
                            value="{{ old('registration_close_at', $event->registration_close_at ? $event->registration_close_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                        >
                    </div>
                </div>
            </div>
            
            <!-- Status -->
            <div class="card">
                <h3 class="text-xl font-bold mb-6">Publicação</h3>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status *
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        class="input @error('status') !border-red-500 @enderror"
                        required
                    >
                        <option value="draft" {{ old('status', $event->status) === 'draft' ? 'selected' : '' }}>Rascunho</option>
                        <option value="published" {{ old('status', $event->status) === 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="closed" {{ old('status', $event->status) === 'closed' ? 'selected' : '' }}>Fechado</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <div class="mt-3 space-y-2 text-sm text-gray-600">
                        <p><strong>Rascunho:</strong> Evento não aparece no site público</p>
                        <p><strong>Publicado:</strong> Evento visível e disponível para inscrições</p>
                        <p><strong>Fechado:</strong> Evento visível mas inscrições bloqueadas</p>
                    </div>
                </div>
            </div>
            
            <!-- Botões -->
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.eventos.show', $event) }}" class="text-gray-600 hover:text-gray-800">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Salvar Alterações
                </button>
            </div>
            
        </form>
        
    </div>
</section>

@push('scripts')
<script>
function previewImage(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('drop-placeholder');
        const dropZone = document.getElementById('drop-zone');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
        dropZone.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}

function toggleRemoveImage(checkbox) {
    const currentWrap = document.getElementById('current-image-wrap');
    const dropZone = document.getElementById('drop-zone');
    if (checkbox.checked) {
        if (currentWrap) currentWrap.style.opacity = '0.4';
        dropZone.classList.remove('hidden');
    } else {
        if (currentWrap) currentWrap.style.opacity = '1';
        dropZone.classList.add('hidden');
    }
}

// Drag & Drop
const dropZone = document.getElementById('drop-zone');
if (dropZone) {
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-primary-500'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-primary-500'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-primary-500');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('image').files = dt.files;
            previewImage(document.getElementById('image'));
        }
    });
}
</script>
@endpush

@endsection
