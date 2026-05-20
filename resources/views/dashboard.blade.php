<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-2xl shadow-sm overflow-hidden relative" style="background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);">
                <div class="p-6 sm:p-8 text-white z-10 relative">
                    <p class="text-sm font-semibold tracking-wider uppercase opacity-80">Selamat Datang Kembali,</p>
                    <h3 class="text-2xl sm:text-3xl font-bold mt-1">{{ $user->name }}!</h3>
                    <p class="text-sm mt-2 opacity-90 max-w-xl">
                        Pantau kondisi anabul kesayangan, kelola data kucing, dan lakukan booking layanan grooming atau penitipan dengan mudah di sini.
                    </p>
                    
                    <div class="mt-6 rounded-xl p-4 inline-flex items-center space-x-4 border border-white/20" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(4px);">
                        <div class="bg-white p-2.5 rounded-lg shadow-inner">
                            🎁
                        </div>
                        <div>
                            <div class="text-xs font-medium text-orange-100">Poin Loyalitas Anda</div>
                            <div class="text-xl font-bold text-white">{{ $user->loyalty_points }} <span class="text-sm font-normal">Poin</span></div>
                        </div>
                    </div>
                </div>
                <div class="absolute right-6 bottom-0 text-9xl opacity-10 pointer-events-none transform translate-y-4 select-none">
                    🐾
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500">Kucing Terdaftar</p>
                        <h4 class="text-3xl font-bold text-gray-800">{{ $totalCats }}</h4>
                    </div>
                    <div class="p-4 rounded-xl text-2xl" style="background-color: #fff7ed; color: #ea580c;">
                        🐱
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500">Booking Aktif</p>
                        <h4 class="text-3xl font-bold text-gray-800">{{ $activeBookingsCount }}</h4>
                    </div>
                    <div class="p-4 rounded-xl text-2xl" style="background-color: #fffbeb; color: #d97706;">
                        📅
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/60 flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-gray-500">Kucing Sedang Dititip</p>
                        <h4 class="text-3xl font-bold text-gray-800">{{ $catsBoardedCount }}</h4>
                    </div>
                    <div class="p-4 rounded-xl text-2xl" style="background-color: #ecfdf5; color: #059669;">
                        🏠
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/60 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center flex-wrap gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">🕒 Transaksi Terbaru</h3>
                        <p class="text-xs text-gray-500">Menampilkan hingga 5 histori transaksi terakhir Anda</p>
                    </div>
                    <a href="{{ route('customer.bookings.create') }}" class="inline-flex items-center text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm" style="background-color: #f97316;">
                        ✨ Booking Sekarang
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Kode Booking</th>
                                <th class="p-4">Kucing</th>
                                <th class="p-4">Layanan</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Total</th>
                                <th class="p-4 text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100 text-gray-700">
                            @forelse ($recentBookings as $booking)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="p-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($booking->start_date)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="p-4 font-mono font-medium text-orange-600 whitespace-nowrap">
                                        {{ $booking->booking_code }}
                                    </td>
                                    <td class="p-4 font-medium whitespace-nowrap">
                                        {{ $booking->cat->name ?? '-' }}
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span class="font-medium block">{{ $booking->service->name ?? '-' }}</span>
                                        <span class="text-xs text-gray-400 capitalize">{{ $booking->service->type ?? '-' }}</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        @if($booking->status === 'pending_payment')
                                            <span class="bg-yellow-50 text-yellow-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-yellow-200">Menunggu Pembayaran</span>
                                        @elseif($booking->status === 'waiting_confirmation')
                                            <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-blue-200">Menunggu Konfirmasi</span>
                                        @elseif($booking->status === 'dp_paid')
                                            <span class="bg-orange-50 text-orange-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-orange-200">DP Dibayar</span>
                                        @elseif($booking->status === 'fully_paid')
                                            <span class="bg-green-50 text-green-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-green-200">Lunas</span>
                                        @elseif($booking->status === 'completed')
                                            <span class="bg-gray-100 text-gray-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-gray-200">Selesai</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="bg-red-50 text-red-700 text-xs px-2.5 py-1 rounded-lg font-medium border border-red-200">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right font-semibold whitespace-nowrap text-gray-900">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-center whitespace-nowrap">
                                        <a href="{{ route('customer.bookings.show', $booking->id) }}" class="inline-flex items-center text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-3 py-1.5 rounded-lg transition">
                                            👁️ Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-gray-400">
                                        <div class="text-3xl mb-2">📦</div>
                                        Belum ada riwayat transaksi booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>