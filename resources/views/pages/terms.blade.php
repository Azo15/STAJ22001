@extends('layouts.main')

@section('title', 'Kullanım Şartları')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="glass-card p-8 md:p-12 rounded-2xl border border-slate-200/60 relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>

        <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 mb-8">Kullanım Şartları</h1>

        <div class="prose prose-slate max-w-none">
            <p class="text-lg text-slate-600 mb-6">
                BOOKA Kütüphane Sistemi'ne hoş geldiniz. Hizmetlerimizi kullanarak aşağıdaki şartları kabul etmiş sayılırsınız. Lütfen bu metni dikkatlice okuyunuz.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">1. Hizmet Kullanımı</h3>
            <p class="text-slate-600 mb-4">
                Sistemi sadece yasal ve etik amaçlarla kullanmayı kabul edersiniz. Aşağıdaki eylemler kesinlikle yasaktır:
            </p>
            <ul class="list-disc pl-5 space-y-2 text-slate-600 mb-6">
                <li>Başkalarının hesaplarına yetkisiz erişim sağlamaya çalışmak.</li>
                <li>Sistemin çalışmasını engelleyecek veya zarar verecek işlemler yapmak.</li>
                <li>Yanlış veya yanıltıcı bilgi beyan etmek.</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">2. Kitap Ödünç Alma ve İade</h3>
            <ul class="list-disc pl-5 space-y-2 text-slate-600 mb-6">
                <li>Ödünç aldığınız kitapları belirtilen süre içinde iade etmekle yükümlüsünüz.</li>
                <li>Geciken iadeler için sistem tarafından belirlenen kısıtlamalar uygulanabilir.</li>
                <li>Kitaplara verilen hasarlardan kullanıcı sorumludur. Kayıp veya ağır hasarlı kitaplar için tazminat talep edilebilir.</li>
            </ul>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">3. Hesap Güvenliği</h3>
            <p class="text-slate-600 mb-6">
                Hesap bilgilerinizin (kullanıcı adı ve şifre) güvenliğinden siz sorumlusunuz. Hesabınızla yapılan tüm işlemlerden sorumlu tutulacaksınız. Şüpheli bir durum fark ederseniz derhal bize bildirmelisiniz.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">4. Değişiklikler</h3>
            <p class="text-slate-600 mb-6">
                Bu kullanım şartlarını zaman zaman güncelleme hakkımız saklıdır. Değişiklikler web sitesinde yayınlandığı andan itibaren geçerli olur. Hizmeti kullanmaya devam etmeniz, değişiklikleri kabul ettiğiniz anlamına gelir.
            </p>

            <h3 class="text-xl font-semibold text-slate-800 mt-8 mb-4">5. Sorumluluk Reddi</h3>
            <p class="text-slate-600">
                Sistem "olduğu gibi" sunulmaktadır. Kesintisiz hizmet garantisi verilmemektedir. Teknik sorunlardan kaynaklanan veri kayıplarından veya hizmet aksamalarından sorumlu değiliz (ancak önlemek için elimizden geleni yapıyoruz).
            </p>
            
            <div class="mt-8 pt-6 border-t border-slate-200">
                <p class="text-sm text-slate-500">Son güncelleme: {{ date('d.m.Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
