<div class="flex flex-col min-h-[100dvh]">
  <header class="flex items-center justify-between px-4 lg:px-6 h-14 bg-[#0A74DA] text-white">
    <a class="flex items-center" href="#">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-6 w-6"
      >
        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
        <path d="M13 5v2"></path>
        <path d="M13 17v2"></path>
        <path d="M13 11v2"></path>
      </svg>
      <span class="ml-2 text-lg font-bold">LuckyGO</span>
    </a>
  </header>
  <main class="flex-1 flex flex-col items-center justify-center px-4 md:px-6 py-12 md:py-24 lg:py-32 bg-white dark:bg-gray-800">
    <div class="max-w-md space-y-6 text-center">
      <div>
        <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Bienvenido a LuckyGO</h1>
        <p class="mt-2 text-gray-500 dark:text-gray-400 md:text-xl">
          Compra tus entradas de manera fácil y segura.
        </p>
      </div>
      <div class="flex flex-col gap-4 sm:flex-row">
        <a
          href="{{ route('ticket.purchase') }}"
          class="inline-flex h-10 items-center justify-center rounded-md bg-[#0A74DA] px-6 text-sm font-medium text-white shadow transition-colors hover:bg-[#0A74DA]/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-[#0A74DA] disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-[#0A74DA] dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
        >
          Comprar Boleto
        </a>
        <a
          href="{{ route('loginForm') }}"
          class="inline-flex h-10 items-center justify-center rounded-md border border-[#0A74DA] bg-white px-6 text-sm font-medium shadow-sm transition-colors hover:bg-gray-100 hover:text-[#0A74DA] focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-[#0A74DA] disabled:pointer-events-none disabled:opacity-50 dark:border-gray-800 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800 dark:hover:text-gray-50 dark:focus-visible:ring-gray-300"
        >
          Iniciar Sesión
        </a>
      </div>
    </div>
  </main>
</div>
