<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo e Descrição -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-4">IAGUS</h3>
                <p class="text-gray-400 mb-4">
                    Igreja Anglicana de Garanhuns<br>
                    Uma família para pertencer.
                </p>
            </div>
            
            <!-- Links Rápidos -->
            <div>
                <h4 class="font-semibold mb-4">Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">Sobre Nós</a></li>
                    <li><a href="{{ route('worship') }}" class="hover:text-white transition">Cultos</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Eventos</a></li>
                    <li><a href="{{ route('youth') }}" class="hover:text-white transition">Juventude</a></li>
                </ul>
            </div>
            
            <!-- Contato -->
            <div>
                <h4 class="font-semibold mb-4">Contato</h4>
                <ul class="space-y-3 text-gray-400 text-sm">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.418 0-8-4.477-8-8A8 8 0 0 1 12 5a8 8 0 0 1 8 8c0 3.523-3.582 8-8 8z"/><circle cx="12" cy="13" r="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ config('app.site_address', 'Garanhuns - PE') }}
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5A2.25 2.25 0 0 0 2.25 6.75m19.5 0-9.75 6.75L2.25 6.75"/></svg>
                        {{ config('app.site_email', 'contato@iagus.org.br') }}
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.338c0-.966.784-1.75 1.75-1.75h2.664c.337 0 .635.19.775.49l1.388 2.982a.875.875 0 0 1-.2.98l-1.077 1.077a13.47 13.47 0 0 0 5.283 5.283l1.077-1.077a.875.875 0 0 1 .98-.2l2.982 1.388c.3.14.49.438.49.775v2.664A1.75 1.75 0 0 1 17.662 21.75C9.18 21.75 2.25 14.82 2.25 6.338z"/></svg>
                        {{ config('app.site_whatsapp', '(87) 9 9999-9999') }}
                    </li>
                </ul>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">
                    IAGUS © {{ date('Y') }}. Todos os direitos reservados.
                </p>
                <p class="text-gray-500 text-sm">
                    Powered by <a href="https://coruzen.com.br" target="_blank" class="text-gray-400 hover:text-primary-400 transition font-medium">Coruzen</a>
                </p>
            </div>
        </div>
    </div>
</footer>
