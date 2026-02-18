@extends('layouts.app')

@section('title', 'Criar Novo Evento - Admin')

@section('content')

<div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.eventos.index') }}" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold">Criar Novo Evento</h1>
        </div>
    </div>
</div>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <form action="{{ route('admin.eventos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
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
                            value="{{ old('title') }}"
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
                            <span class="text-gray-500 text-xs">(deixe vazio para gerar automaticamente)</span>
                        </label>
                        <input 
                            type="text" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug') }}"
                            class="input @error('slug') !border-red-500 @enderror"
                            placeholder="retiro-de-carnaval-2026"
                        >
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                        >{{ old('description') }}</textarea>
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
                        >{{ old('instructions') }}</textarea>
                    </div>
                    
                    <!-- Imagem do Evento -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem do Evento
                            <span class="text-gray-500 text-xs">(JPEG, PNG, WebP – máx. 5 MB)</span>
                        </label>

                        <!-- Drop zone -->
                        <div id="drop-zone"
                             class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-primary-400 transition-colors bg-gray-50 hover:bg-primary-50/30"
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
                            value="{{ old('start_at') }}"
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
                            value="{{ old('end_at') }}"
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
                            value="{{ old('location_name') }}"
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
                            value="{{ old('location_address') }}"
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
                            value="{{ old('capacity') }}"
                            min="1"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                            placeholder="50"
                        >
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
                            value="{{ old('price_cents', 0) }}"
                            min="0"
                            class="input @error('price_cents') !border-red-500 @enderror"
                            required
                        >
                        @error('price_cents')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                            value="{{ old('registration_open_at') }}"
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
                            value="{{ old('registration_close_at') }}"
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
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publicado</option>
                        <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>Fechado</option>
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
                <a href="{{ route('admin.eventos.index') }}" class="text-gray-600 hover:text-gray-800">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    Criar Evento
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
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

// Drag & Drop
const dropZone = document.getElementById('drop-zone');
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
</script>
@endpush

@endsection
