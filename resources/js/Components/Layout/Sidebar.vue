<template>
  <aside class="w-64 h-screen bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700">
    <div class="p-6 text-xl font-bold text-gray-800 dark:text-white">
      RDVApp
    </div>
    <nav class="mt-4">
      <ul class="space-y-1">
        <li>
          <Link href="/dashboard" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200" :class="{ 'bg-gray-100 dark:bg-gray-800': $page.url.startsWith('/dashboard') }">
            Dashboard
          </Link>
        </li>
        <li>
          <Link href="/appointments" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200" :class="{ 'bg-gray-100 dark:bg-gray-800': $page.url.startsWith('/appointments') }">
            Appointments
          </Link>
        </li>
        <li>
          <Link href="/users" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200" :class="{ 'bg-gray-100 dark:bg-gray-800': $page.url.startsWith('/users') }">
            Users
          </Link>
        </li>
        <li>
          <Link href="/settings" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-200" :class="{ 'bg-gray-100 dark:bg-gray-800': $page.url.startsWith('/settings') }">
            Settings
          </Link>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
</script>
