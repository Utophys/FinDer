@extends('layouts.dss') {{-- Pastikan nama layout ini benar --}}

@section('content')
    {{-- ... (bagian HTML Anda yang lain tetap sama) ... --}}
    <div class="flex flex-col items-center justify-start min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8 relative">
        {{-- Tombol Kembali dan Logo --}}
        <div class="w-full max-w-2xl mb-6">
            <div class="flex justify-between items-center">
                <a href="#" class="text-gray-600 hover:text-gray-800 transition-colors duration-150"
                    onclick="goBack(); return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <div class="text-2xl font-black text-blue-600" style="font-family: 'Arial Black', sans-serif;">
                    FinDer
                </div>
            </div>
        </div>

        {{-- Area Kuesioner --}}
        <div id="questionnaire-area" class="w-full max-w-2xl">
            {{-- Pertanyaan akan di-render di sini oleh JavaScript --}}
        </div>

        {{-- Pesan Selesai --}}
        <div id="completion-message" class="hidden w-full max-w-2xl bg-white p-8 rounded-lg shadow-xl text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Terima Kasih!</h2>
            <p class="text-gray-600 mb-6" id="completion-text">Anda telah menyelesaikan kuesioner. Jawaban Anda akan kami proses.</p>
            <button
                id="restart-button"
                class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-150 ease-in-out"
                onclick="restartQuestionnaire()">
                Ulangi Kuesioner
            </button>
            <button
                id="view-results-button"
                class="hidden w-full sm:w-auto mt-4 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-150 ease-in-out">
                Lihat Hasil Rekomendasi
            </button>
        </div>
    </div>

    <script>
        const USER_ID = "{{ Auth::check() ? Auth::id() : '' }}";
        const SUBMIT_URL = "{{ route('user.dss.storeResult') }}"; // Pastikan nama route ini benar
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const RESULTS_PAGE_URL = "{{ Route::has('user.results.index') ? route('user.results.index') : '#' }}";
        const HOMEPAGE_URL = "{{ Route::has('homepage') ? route('homepage') : (Route::has('user.homepage') ? route('user.homepage') : '#') }}";

        console.log("USER_ID:", USER_ID);
        console.log("SUBMIT_URL:", SUBMIT_URL);
        console.log("CSRF_TOKEN:", CSRF_TOKEN);
    </script>

    <script>
        const questions = [
            {
                id: 1, // ID internal untuk JS
                dbCriteriaId: "CRT00001", // ID aktual di database
                text: "Seberapa besar pengaruh harga awal ikan terhadap keputusan Anda?",
                meta: "Pertanyaan 1/7 - Nilai/Harga",
                options: [
                    { text: "Harga harus paling pas di kantong.", value: "sangat_penting_harga", type: "primary" },
                    { text: "Harga penting, tapi fleksibel.", value: "penting_harga", type: "secondary" },
                    { text: "Kualitas lebih utama dari harga.", value: "kurang_penting_harga", type: "primary" },
                    { text: "Harga bukan masalah utama.", value: "tidak_penting_harga", type: "secondary" }
                ]
            },
            {
                id: 2,
                dbCriteriaId: "CRT00002",
                text: "Memikirkan perawatan ikan, seberapa penting kemudahan dalam merawatnya?",
                meta: "Pertanyaan 2/7 - Kompleksitas Pemeliharaan",
                options: [
                    { text: "Harus yang perawatannya super simpel!", value: "sangat_penting_kompleksitas", type: "primary" },
                    { text: "Penting, lebih suka yang mudah dirawat.", value: "penting_kompleksitas", type: "secondary" },
                    { text: "Siap jika butuh perawatan lebih.", value: "kurang_penting_kompleksitas", type: "primary" },
                    { text: "Kompleksitas perawatan? Oke saja!", value: "tidak_penting_kompleksitas", type: "secondary" }
                ]
            },
            {
                id: 3,
                dbCriteriaId: "CRT00003",
                text: "Bagaimana pertimbangan Anda terhadap biaya rutin pemeliharaan ikan?",
                meta: "Pertanyaan 3/7 - Biaya Pemeliharaan",
                options: [
                    { text: "Biaya rutin harus sangat minim.", value: "sangat_penting_biaya_rawat", type: "primary" },
                    { text: "Biaya rutin jadi perhatian, tapi fleksibel.", value: "penting_biaya_rawat", type: "secondary" },
                    { text: "Kesehatan ikan lebih penting dari biaya.", value: "kurang_penting_biaya_rawat", type: "primary" },
                    { text: "Biaya rutin tidak jadi masalah.", value: "tidak_penting_biaya_rawat", type: "secondary" }
                ]
            },
            {
                id: 4,
                dbCriteriaId: "CRT00004",
                text: "Mengenai ukuran maksimal ikan dewasa, seberapa penting ini bagi Anda?",
                meta: "Pertanyaan 4/7 - Ukuran",
                options: [
                    { text: "Ukuran harus pas dengan akuarium.", value: "sangat_penting_ukuran", type: "primary" },
                    { text: "Ukuran dewasa jadi pertimbangan.", value: "penting_ukuran", type: "secondary" },
                    { text: "Cukup fleksibel soal ukuran ikan.", value: "kurang_penting_ukuran", type: "primary" },
                    { text: "Ukuran ikan bukan batasan.", value: "tidak_penting_ukuran", type: "secondary" }
                ]
            },
            {
                id: 5,
                dbCriteriaId: "CRT00005",
                text: "Seberapa menarik bagi Anda untuk memiliki ikan yang langka atau unik?",
                meta: "Pertanyaan 5/7 - Kelangkaan",
                options: [
                    { text: "Sangat suka ikan langka & eksklusif!", value: "sangat_penting_langka", type: "primary" },
                    { text: "Ikan langka jadi nilai tambah.", value: "penting_langka", type: "secondary" },
                    { text: "Kelangkaan bukan prioritas utama.", value: "kurang_penting_langka", type: "primary" },
                    { text: "Langka atau umum, tidak beda jauh.", value: "tidak_penting_langka", type: "secondary" }
                ]
            },
            {
                id: 6,
                dbCriteriaId: "CRT00006",
                text: "Seberapa besar peran keindahan visual ikan dalam pilihan Anda?",
                meta: "Pertanyaan 6/7 - Estetika",
                options: [
                    { text: "Keindahan visual prioritas utama!", value: "sangat_penting_estetika", type: "primary" },
                    { text: "Tampilan ikan itu penting buat saya.", value: "penting_estetika", type: "secondary" },
                    { text: "Estetika hanya sebagai bonus.", value: "kurang_penting_estetika", type: "primary" },
                    { text: "Penampilan tidak terlalu difokuskan.", value: "tidak_penting_estetika", type: "secondary" }
                ]
            },
            {
                id: 7,
                dbCriteriaId: "CRT00007",
                text: "Seberapa penting karakter atau tingkah laku unik ikan bagi Anda?",
                meta: "Pertanyaan 7/7 - Perilaku",
                options: [
                    { text: "Perilaku unik & interaktif itu kunci!", value: "sangat_penting_perilaku", type: "primary" },
                    { text: "Suka ikan dengan perilaku menarik.", value: "penting_perilaku", type: "secondary" },
                    { text: "Perilaku standar sudah cukup baik.", value: "kurang_penting_perilaku", type: "primary" },
                    { text: "Tidak ada preferensi soal perilaku.", value: "tidak_penting_perilaku", type: "secondary" }
                ]
            }
        ];

        let currentQuestionIndex = 0;
        let userAnswers = []; // Akan menyimpan objek { questionIdInternal, dbCriteriaId, answerValue }

        const questionnaireArea = document.getElementById('questionnaire-area');
        const completionMessage = document.getElementById('completion-message');
        const completionText = document.getElementById('completion-text');
        const restartButton = document.getElementById('restart-button');
        const viewResultsButton = document.getElementById('view-results-button');

        function displayQuestion(index) {
            // ... (fungsi displayQuestion tetap sama) ...
            questionnaireArea.innerHTML = '';
            completionMessage.classList.add('hidden');
            questionnaireArea.classList.remove('hidden');
            viewResultsButton.classList.add('hidden');


            if (index >= questions.length) {
                showCompletionMessageAndSubmit(); // Nama fungsi diubah untuk kejelasan
                return;
            }

            const question = questions[index];
            const questionContainer = document.createElement('div');
            questionContainer.className = 'bg-white p-6 sm:p-8 rounded-lg shadow-xl text-center w-full';

            const questionMeta = document.createElement('p');
            questionMeta.className = 'text-sm text-gray-500 mb-2 sm:mb-4';
            questionMeta.textContent = question.meta;

            const questionText = document.createElement('h2');
            questionText.className = 'text-xl sm:text-2xl font-semibold text-gray-800 mb-6 sm:mb-8';
            questionText.textContent = question.text;

            questionContainer.appendChild(questionMeta);
            questionContainer.appendChild(questionText);

            const showOptionsButton = document.createElement('button');
            showOptionsButton.textContent = 'Next';
            showOptionsButton.className = 'w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-150 ease-in-out';
            showOptionsButton.onclick = () => {
                displayOptions(questionContainer, question);
                showOptionsButton.classList.add('hidden');
            };

            questionContainer.appendChild(showOptionsButton);
            questionnaireArea.appendChild(questionContainer);
        }

        function displayOptions(questionContainerElement, question) {
            // ... (fungsi displayOptions tetap sama, pastikan `question` yang di-pass berisi dbCriteriaId) ...
            const optionsDiv = document.createElement('div');
            optionsDiv.className = 'mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4';

            question.options.forEach(option => {
                const optionButton = document.createElement('button');
                optionButton.textContent = option.text;
                let buttonClasses = 'w-full text-white font-medium py-3 px-4 rounded-lg transition-colors duration-150 ease-in-out text-sm sm:text-base';
                if (option.type === 'secondary') {
                    buttonClasses += ' bg-green-500 hover:bg-green-600';
                } else {
                    buttonClasses += ' bg-blue-500 hover:bg-blue-600';
                }
                optionButton.className = buttonClasses;
                optionButton.onclick = () => {
                    // Saat memilih jawaban, kita simpan id internal JS dan dbCriteriaId
                    selectAnswer(question.id, question.dbCriteriaId, option.value);
                };
                optionsDiv.appendChild(optionButton);
            });
            questionContainerElement.appendChild(optionsDiv);
        }

        function selectAnswer(questionIdInternal, dbCriteriaId, answerValue) {
            // Hapus jawaban sebelumnya untuk pertanyaan ini jika ada (untuk kasus tombol back)
            userAnswers = userAnswers.filter(ans => ans.questionIdInternal !== questionIdInternal);
            // Tambahkan jawaban baru
            userAnswers.push({ questionIdInternal: questionIdInternal, dbCriteriaId: dbCriteriaId, answerValue: answerValue });

            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                displayQuestion(currentQuestionIndex);
            } else {
                showCompletionMessageAndSubmit();
            }
        }

        function showCompletionMessageAndSubmit() {
            questionnaireArea.classList.add('hidden');
            completionMessage.classList.remove('hidden');
            restartButton.classList.remove('hidden');
            viewResultsButton.classList.add('hidden');

            console.log("Kuesioner Selesai. Jawaban mentah:", userAnswers);

            let payloadCriteria = {};
            userAnswers.forEach(answer => {
                const actualCriteriaId = answer.dbCriteriaId; // <-- GUNAKAN INI
                const answerValue = answer.answerValue;

                let weightInt = 0;
                if (answerValue.startsWith('sangat_penting_')) {
                    weightInt = 4;
                } else if (answerValue.startsWith('penting_')) {
                    weightInt = 3;
                } else if (answerValue.startsWith('kurang_penting_')) {
                    weightInt = 2;
                } else if (answerValue.startsWith('tidak_penting_')) {
                    weightInt = 1;
                }
                payloadCriteria[actualCriteriaId] = weightInt; // <-- Kunci sekarang adalah dbCriteriaId
            });

            const dataToSend = {
                user_id: USER_ID,
                criteria: payloadCriteria
            };

            console.log("Data yang akan dikirim ke server (dengan dbCriteriaId):", JSON.stringify(dataToSend, null, 2)); // Log data yang sudah benar

            completionText.textContent = 'Sedang memproses jawaban Anda...';
            restartButton.disabled = true;

            fetch(SUBMIT_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(dataToSend)
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                    return null;
                }
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data) {
                    completionText.textContent = data.message || 'Jawaban berhasil dikirim!';
                    restartButton.disabled = false;
                    if (data.success && RESULTS_PAGE_URL && RESULTS_PAGE_URL !== '#') {
                        viewResultsButton.classList.remove('hidden');
                        viewResultsButton.onclick = () => { window.location.href = RESULTS_PAGE_URL; };
                    }
                }
            })
            .catch(error => {
                console.error('Error saat mengirim data:', error);
                let errorMessage = 'Terjadi kesalahan saat mengirim jawaban.';
                if (error.message) {
                    errorMessage += ` Pesan: ${error.message}.`;
                }
                if (error.errors) {
                    errorMessage += ' Rincian: ';
                    for (const key in error.errors) {
                        errorMessage += `${error.errors[key].join(', ')} `;
                    }
                }
                completionText.textContent = errorMessage;
                restartButton.disabled = false;
            });
        }

        function restartQuestionnaire() {
            currentQuestionIndex = 0;
            userAnswers = [];
            completionText.textContent = 'Anda telah menyelesaikan kuesioner. Jawaban Anda akan kami proses.';
            displayQuestion(currentQuestionIndex);
        }

        function goBack() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                // Hapus jawaban untuk pertanyaan yang akan ditampilkan kembali,
                // agar pengguna bisa memilih ulang jika mau.
                // Identifikasi berdasarkan questionIdInternal.
                const questionToGoBackTo = questions[currentQuestionIndex];
                userAnswers = userAnswers.filter(ans => ans.questionIdInternal !== questionToGoBackTo.id);

                displayQuestion(currentQuestionIndex);
            } else {
                if (HOMEPAGE_URL && HOMEPAGE_URL !== '#') {
                    window.location.href = HOMEPAGE_URL;
                } else {
                    alert("Anda sudah di pertanyaan pertama.");
                }
            }
        }
        displayQuestion(currentQuestionIndex);
    </script>
@endsection