@extends('main', ['excludeNavbar' => true], ['excludeFooter' => true])

@section('content')
<div x-data="dashboardApp()" x-init="init()"
   :class="dark ? 'dark' : ''"
   class="min-h-screen font-sans bg-[#0b0b0b] dark:bg-[#f8fafc] transition-colors duration-300">
   <header class="flex flex-col md:flex-row items-center justify-between px-4 md:px-6 py-4 border-b border-white/6 dark:border-gray-200/6 backdrop-blur-md bg-white/3 dark:bg-white/5 gap-3">

      <div class="flex items-center gap-4 w-full md:w-auto justify-between">
         <div class="flex items-center gap-3">
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg bg-white/5 hover:bg-white/10 transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white dark:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
               </svg>
            </button>

            <a href="#" class="flex items-center gap-3">
               <img src="{{ asset('img/logoWeb-bosskuInbound.png') }}" alt="Bossku.Tours" class="w-20 md:w-24">
            </a>
         </div>

         <div class="md:hidden flex items-center gap-2">
            <button @click="toggleDark()" :title="dark ? 'Switch to Light' : 'Switch to Dark'"
               class="p-2 rounded-lg bg-white/5  hover:bg-white/10 transition">
               <template x-if="!dark">
                  <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 5.47a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.708-.707a1 1 0 010-1.414zM2 11a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm3.78 5.53a1 1 0 000-1.414l.708-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM15.78 14.53a1 1 0 01-1.414 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.414zM17 11a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.78 5.47a1 1 0 010 1.414l-.707.707A1 1 0 0113.657 6.17l.707-.707a1 1 0 011.414 0z" />
                     <path d="M10 6a4 4 0 100 8 4 4 0 000-8z" />
                  </svg>
               </template>
               <template x-if="dark">
                  <svg class="h-5 w-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M17.293 13.293A8 8 0 116.707 2.707 7 7 0 1017.293 13.293z" />
                  </svg>
               </template>
            </button>

         </div>
      </div>

      <div class="flex items-center gap-4 w-full md:w-auto justify-end">
         <div class="hidden md:flex items-center gap-4">

            <button @click="toggleDark()" :title="dark ? 'Switch to Light' : 'Switch to Dark'"
               class="flex items-center gap-2 px-3 py-2 rounded-lg bg-white/5 hover:bg-white/10 transition">
               <template x-if="!dark">
                  <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 5.47a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.708-.707a1 1 0 010-1.414zM2 11a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm3.78 5.53a1 1 0 000-1.414l.708-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM15.78 14.53a1 1 0 01-1.414 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.414zM17 11a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.78 5.47a1 1 0 010 1.414l-.707.707A1 1 0 0113.657 6.17l.707-.707a1 1 0 011.414 0z" />
                     <path d="M10 6a4 4 0 100 8 4 4 0 000-8z" />
                  </svg>
               </template>
               <template x-if="dark">
                  <svg class="h-5 w-5 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M17.293 13.293A8 8 0 116.707 2.707 7 7 0 1017.293 13.293z" />
                  </svg>
               </template>
               <span class="text-sm text-white dark:text-gray-800" x-text="dark ? 'Light' : 'Dark'"></span>
            </button>

            <div class="flex items-center gap-3">
               <p class="text-sm text-gray-300 dark:text-gray-700">Welcome back,</p>

               <div class="text-sm font-medium text-[#bfa46f] dark:text-[#bfa46f]">
                  {{ auth()->user()->name }}
               </div>

               <a href="{{ route('logout') }}"
                  class="px-3 py-2 rounded-lg bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white text-sm hover:opacity-95 transition">
                  Logout
               </a>
            </div>

         </div>

         <div class="md:hidden flex items-center gap-2">
            <a href="{{ route('logout') }}" class="px-2 py-1 rounded-md bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white text-sm">Logout</a>
         </div>
      </div>
   </header>

   <div class="flex">
      <aside class="z-20">
         <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/50 md:hidden" @click="sidebarOpen=false"></div>

         <nav
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            x-transition:enter="transition-transform duration-300"
            x-transition:leave="transition-transform duration-300"
            class="fixed md:relative top-0 left-0 h-full w-72 md:w-64 bg-black dark:bg-[#f8fafc] md:bg-transparent md:backdrop-blur-none p-4 md:p-4 md:pt-8 transform md:translate-x-0 shadow-xl md:shadow-none overflow-auto">
            <div class="flex items-center justify-between mb-6">
               <div class="hidden md:flex items-center gap-3">
                  <div class="text-white dark:text-gray-800">
                     <div class="font-semibold">Bossku<span class="text-[#bfa46f]">.Tours</span></div>
                     <div class="text-xs text-gray-300 dark:text-gray-600">Admin Panel</div>
                  </div>
               </div>

               <button @click="collapsed = !collapsed" class="md:block hidden p-2 rounded-md bg-white/5 dark:bg-gray-900 hover:bg-white/10 hover:dark:bg-black transition">
                  <svg x-show="!collapsed" class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
                  <svg x-show="collapsed" class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
               </button>
            </div>

            <ul class="space-y-2">
               <li>
                  <a href="#/dashboard" @click="go('#/dashboard')" :class="active === 'dashboard' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60   hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-heroicon-s-home class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'Dashboard'"></span>
                  </a>
               </li>

               <li>
                  <a href="#/insights" @click="go('#/insights')" :class="active === 'insights' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60  hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-zondicon-travel-case class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'Insights'"></span>
                  </a>
               </li>

               <li>
                  <a href="#/documents" @click="go('#/documents')" :class="active === 'documents' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60   hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-heroicon-s-document class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'documents'"></span>
                  </a>
               </li>

               <li>
                  <a href="#/nina" @click="go('#/nina')" :class="active === 'nina' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60   hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-ri-customer-service-2-fill class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'Nina Reminder'"></span>
                  </a>
               </li>

               <li>
                  <a href="#/leads" @click="go('#/leads')" :class="active === 'leads' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60   hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-heroicon-s-user-plus class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'Leads'"></span>
                  </a>
               </li>

               <li>
                  <a href="#/settings" @click="go('#/settings')" :class="active === 'settings' ? 'bg-white/6 text-white dark:text-gray-700 font-bold' : 'text-white/60 dark:text-black/60   hover:text-white hover:dark:text-black'" class="flex items-center gap-3 px-4 py-3 rounded-lg transition w-full">
                     <x-uni-setting-o class="w-5 h-5" />
                     <span x-text="collapsed ? '' : 'Settings'"></span>
                  </a>
               </li>
            </ul>

            <div class="mt-6 text-xs text-gray-400" x-show="!collapsed" x-transition>
               <p>Version 1.0.0 © Bossku.Tours</p>
            </div>
         </nav>
      </aside>

      <main class="flex-1 p-4 md:p-8 relative">
         <div class="space-y-6">
            <section x-show="active === 'dashboard'" x-transition.opacity x-cloak>
               @include('admin.layout.dashboard')
            </section>

            <section x-show="active === 'insights'" x-transition.opacity x-cloak>
               @include('admin.layout.insights')
            </section>

            <section x-show="active === 'documents'" x-transition.opacity x-cloak>
               @include('admin.layout.documents')
            </section>

            <section x-show="active === 'nina'" x-transition.opacity x-cloak>
               @include('admin.layout.nina')
            </section>

            <section x-show="active === 'leads'" x-transition.opacity x-cloak>
               @include('admin.layout.leads')
            </section>

            <section x-show="active === 'settings'" x-transition.opacity x-cloak>
               @include('admin.layout.settings')
            </section>
         </div>
      </main>
   </div>
</div>

<script>
   document.addEventListener('alpine:init', () => {
      Alpine.data('dashboardApp', () => ({
         dark: false,
         sidebarOpen: false,
         collapsed: false,
         active: 'dashboard',

         init() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme !== null) {
               this.dark = savedTheme === 'dark';
            } else {
               this.dark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
            this.applyTheme();

            const h = window.location.hash.replace('#/', '');
            this.active = h ? h : 'dashboard';
            window.addEventListener('hashchange', () => {
               const newh = window.location.hash.replace('#/', '');
               this.active = newh ? newh : 'dashboard';
               this.sidebarOpen = false;
            });

            window.addEventListener('keydown', (e) => {
               if (e.key === 'Escape') this.sidebarOpen = false;
            });
         },

         go(hash) {
            window.location.hash = hash;
            this.sidebarOpen = false;
            this.active = (hash || '#/dashboard').replace('#/', '');
         },

         toggleDark() {
            this.dark = !this.dark;
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            this.applyTheme();
         },

         applyTheme() {
            if (this.dark) {
               document.documentElement.classList.add('dark');
            } else {
               document.documentElement.classList.remove('dark');
            }
         }
      }));
   });
</script>

<style>
   :root {
      color-scheme: dark;
   }

   .dark {
      color-scheme: light;
   }

   [x-cloak] {
      display: none !important;
   }
</style>
@endsection