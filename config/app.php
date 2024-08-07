<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uygulama Adı
    |--------------------------------------------------------------------------
    |
    | Bu değer, uygulamanızın adıdır. Framework'ün bildirim veya
    | diğer UI öğelerinde uygulama adının gösterilmesi gereken yerlerde kullanılır.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Ortamı
    |--------------------------------------------------------------------------
    |
    | Bu değer, uygulamanızın şu anda çalıştığı "ortamı" belirler. Bu, çeşitli
    | servisleri nasıl yapılandırmayı tercih ettiğinizi belirleyebilir.
    | ".env" dosyanızda ayarlayın.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Hata Ayıklama Modu
    |--------------------------------------------------------------------------
    |
    | Uygulamanız hata ayıklama modunda olduğunda, her hatada ayrıntılı hata
    | mesajları ve yığıın izleri gösterilir. Devre dışı bırakıldığında,
    | basit bir genel hata sayfası gösterilir.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Uygulama URL
    |--------------------------------------------------------------------------
    |
    | Bu URL, Artisan komut satırı aracını kullanırken doğru şekilde URL'ler
    | oluşturmak için kullanılır. Artisan komutları içinde kullanılabilir olmalıdır.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Zaman Dilimi
    |--------------------------------------------------------------------------
    |
    | Burada uygulamanız için varsayılan zaman dilimini belirtebilirsiniz. Bu,
    | PHP tarih ve saat işlevleri tarafından kullanılacaktır. Varsayılan olarak
    | "UTC" olarak ayarlanmıştır, çoğu kullanım durumu için uygun bir seçenektir.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'Europe/Istanbul'),

    /*
    |--------------------------------------------------------------------------
    | Uygulama Dil Yapılandırması
    |--------------------------------------------------------------------------
    |
    | Uygulama dil ayarı, Laravel'in çeviri / yerelleştirme yöntemlerinde
    | kullanılacak varsayılan dil kodunu belirler.
    |
    */

    'locale' => env('APP_LOCALE', 'tr'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'tr'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'tr_TR'),

    /*
    |--------------------------------------------------------------------------
    | Şifreleme Anahtarı
    |--------------------------------------------------------------------------
    |
    | Bu anahtar, Laravel'in şifreleme hizmetleri tarafından kullanılır ve tüm
    | şifrelenmiş değerlerin güvenli olduğundan emin olmak için rastgele,
    | 32 karakterlik bir dize olarak ayarlanmalıdır.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Bakım Modu Sürücüsü
    |--------------------------------------------------------------------------
    |
    | Bu yapılandırma seçenekleri, Laravel'in "bakım modu" durumunu belirlemek ve
    | yönetmek için kullanılan sürücüyü belirler. "cache" sürücüsü, bakım modunun
    | birden fazla makine üzerinde kontrol edilmesine izin verir.
    |
    | Desteklenen sürücüler: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
