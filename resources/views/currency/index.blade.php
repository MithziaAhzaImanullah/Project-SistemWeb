<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konverter Mata Uang - Jelajah Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🇮🇩</span>
                    <a href="/wisata-desain" class="text-2xl font-black tracking-tight bg-gradient-to-r from-emerald-600 to-teal-700 bg-clip-text text-transparent">
                        Jelajah<span class="text-slate-900 font-semibold">Indonesia</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/wisata-desain" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Beranda</a>
                    <a href="/currency-desain" class="text-sm font-medium text-emerald-600 font-semibold transition">Konverter Kurs</a>
                    <a href="#" class="text-sm font-medium text-slate-600 hover:text-emerald-600 transition">Favorit Saya</a>
                    <div class="h-5 w-[1px] bg-slate-200"></div>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-700 hover:text-emerald-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-emerald-600 transition mr-2">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md shadow-emerald-100 transition">
                            Daftar Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-4">
                💱 Fitur Kalkulator Kurs Real-Time
            </span>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Konverter Mata Uang Asing ke Rupiah</h1>
            <p class="text-slate-500 mt-2 text-sm sm:text-base max-w-xl mx-auto">
                Hitung estimasi pengeluaran perjalananmu dengan data kurs terkini langsung dari ExchangeRate-API.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100">
            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div class="space-y-2">
                        <label for="amount" class="block text-sm font-bold text-slate-700">Jumlah Mata Uang Asing</label>
                        <div class="relative rounded-xl bg-slate-50 border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100 transition">
                            <input type="number" id="amount" name="amount" value="100" min="0" step="0.01"
                                class="w-full py-3.5 pl-4 pr-12 bg-transparent text-slate-900 font-semibold focus:outline-none text-base"
                                placeholder="0.00">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="from_currency" class="block text-sm font-bold text-slate-700">Mata Uang Asal</label>
                        <select id="from_currency" name="from_currency"
                            class="w-full py-3.5 px-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-medium focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition text-base">
                            <option value="USD">USD - United States Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="SGD">SGD - Singapore Dollar</option>
                            <option value="MYR">MYR - Malaysian Ringgit</option>
                            <option value="SAR">SAR - Saudi Arabian Riyal</option>
                            <option value="GBP">GBP - British Pound</option>
                            <option value="JPY">JPY - Japanese Yen</option>
                            <option value="AUD">AUD - Australian Dollar</option>
                        </select>
                    </div>

                </div>

                <button id="btn-convert" type="button"
                    class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm disabled:opacity-60 disabled:cursor-not-allowed">
                    Konversi Sekarang
                </button>
            </div>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center space-y-2">
                <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Hasil Estimasi Konversi</p>

                <div id="result-loading" class="hidden">
                    <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-emerald-600 border-t-transparent"></div>
                    <p class="text-sm text-slate-400 mt-2">Mengambil data kurs terkini...</p>
                </div>

                <div id="result-error" class="hidden">
                    <p class="text-red-500 font-semibold text-sm" id="result-error-msg">Terjadi kesalahan.</p>
                </div>

                <div id="result-success">
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight" id="result-text">
                        — pilih mata uang dan klik Konversi —
                    </div>
                    <p id="result-rate" class="text-xs text-slate-400 mt-2"></p>
                </div>

                <p class="text-xs text-slate-400 italic">
                    *Nilai tukar ini bersifat estimasi real-time untuk kebutuhan perencanaan perjalanan wisata.
                </p>
            </div>
        </div>
    </main>

    <script>
        const btn = document.getElementById('btn-convert');
        const amountInput = document.getElementById('amount');
        const currencySelect = document.getElementById('from_currency');
        const resultLoading = document.getElementById('result-loading');
        const resultError = document.getElementById('result-error');
        const resultErrorMsg = document.getElementById('result-error-msg');
        const resultSuccess = document.getElementById('result-success');
        const resultText = document.getElementById('result-text');
        const resultRate = document.getElementById('result-rate');

        btn.addEventListener('click', async function () {
            const amount = parseFloat(amountInput.value);
            const from = currencySelect.value;

            if (!amount || amount <= 0) {
                alert('Masukkan jumlah yang valid (lebih dari 0).');
                return;
            }

            btn.disabled = true;
            resultLoading.classList.remove('hidden');
            resultError.classList.add('hidden');
            resultSuccess.classList.add('hidden');

            try {
                const response = await fetch(`/api/v1/currency/convert?from=${from}&amount=${amount}`, {
                    headers: { 'Accept': 'application/json' }
                });

                const data = await response.json();

                if (data.status === 'success') {
                    const idr = new Intl.NumberFormat('id-ID', {
                        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
                    }).format(data.data.result);

                    resultText.innerHTML = `${amount} ${from} = <span class="text-emerald-600">${idr}</span>`;
                    resultRate.textContent = `1 ${from} = Rp ${new Intl.NumberFormat('id-ID').format(data.data.rate)} | Diperbarui: ${data.data.last_updated}`;
                    resultSuccess.classList.remove('hidden');
                } else {
                    resultErrorMsg.textContent = data.message || 'Gagal mengambil data kurs. Periksa API key ExchangeRate.';
                    resultError.classList.remove('hidden');
                }
            } catch (err) {
                resultErrorMsg.textContent = 'Terjadi kesalahan jaringan. Pastikan server berjalan.';
                resultError.classList.remove('hidden');
            } finally {
                resultLoading.classList.add('hidden');
                btn.disabled = false;
            }
        });
    </script>

</body>
</html>