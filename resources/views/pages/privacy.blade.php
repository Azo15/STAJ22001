@extends('layouts.main')

@section('title', 'Gizlilik Politikası')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="glass-card p-8 md:p-12 rounded-2xl border border-slate-200/60 relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>

        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 mb-8">Gizlilik Politikası</h1>

        <div class="prose prose-slate max-w-none">
            <p class="text-lg text-slate-600 mb-6">
                BOOKA Kütüphane Sistemi ("Biz", "Sistemimiz") olarak, gizliliğinize önem veriyoruz. Bu Gizlilik Politikası, web sitemizi ve hizmetlerimizi kullanırken kişisel verilerinizin nasıl toplandığını, kullanıldığını ve korunduğunu açıklar.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">1. Toplanan Bilgiler</h3>
            <p class="text-slate-600 mb-4">
                Hizmetlerimizi kullandığınızda aşağıdaki bilgileri toplayabiliriz:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-slate-600 mb-6">
                <li><strong>Kişisel Kimlik Bilgileri:</strong> Ad, soyad, e-posta adresi, telefon numarası gibi kayıt olurken sağladığınız bilgiler.</li>
                <li><strong>Kullanım Verileri:</strong> Ödünç aldığınız kitaplar, arama geçmişiniz ve favorileriniz gibi sistem içi aktiviteler.</li>
                <li><strong>Teknik Veriler:</strong> IP adresi, tarayıcı türü ve cihaz bilgileri gibi otomatik olarak toplanan veriler.</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">2. Bilgilerin Kullanımı</h3>
            <p class="text-slate-600 mb-4">
                Topladığımız bilgileri şu amaçlarla kullanırız:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-slate-600 mb-6">
                <li>Hizmetlerimizi sağlamak ve iyileştirmek.</li>
                <li>Ödünç alma işlemlerini yönetmek ve takip etmek.</li>
                <li>Size önemli bildirimler (iade tarihleri, yeni kitaplar vb.) göndermek.</li>
                <li>Sistem güvenliğini sağlamak ve hataları gidermek.</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">3. Veri Güvenliği</h3>
            <p class="text-slate-600 mb-6">
                Kişisel verilerinizin güvenliği bizim için önceliklidir. Verilerinizi yetkisiz erişime, değişikliğe veya ifşaya karşı korumak için endüstri standardı güvenlik önlemleri uyguluyoruz. Şifreleriniz veritabanımızda hashlenmiş (şifrelenmiş) olarak saklanır.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">4. Çerezler (Cookies)</h3>
            <p class="text-slate-600 mb-6">
                Web sitemiz, kullanıcı deneyimini geliştirmek ve oturumunuzu açık tutmak için çerezleri kullanır. Tarayıcı ayarlarınızdan çerezleri yönetebilir veya engelleyebilirsiniz, ancak bu bazı özelliklerin çalışmasını etkileyebilir.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">5. İletişim</h3>
            <p class="text-slate-600">
                Gizlilik politikamızla ilgili herhangi bir sorunuz varsa, lütfen <a href="{{ route('contact') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">İletişim</a> sayfasından bizimle irtibata geçin.
            </p>
            
            <div class="mt-8 pt-6 border-t border-slate-200">
                <p class="text-sm text-slate-500">Son güncelleme: {{ date('d.m.Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
