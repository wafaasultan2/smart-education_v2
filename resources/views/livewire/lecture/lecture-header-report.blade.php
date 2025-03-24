<div style="position: relative; width: 100%; height: 100px">
    <!-- اسم الجامعة (يسار) -->
    <div style="position: absolute; right: 0; font-size: 18px;">
        جامعة صنعاء<br/>
        {{ $name }}
    </div>

    <!-- الشعار (وسط) -->
    <div style="position: absolute; left: 45%; transform: translateX(-45%);">
        <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(storage_path('app/public/'.$logo))) }}"
            alt="logo" style="height: 80px; width: auto; max-width: 100px;">
    </div>

    <!-- التاريخ (يمين) -->
    <div style="position: absolute; left: 0;  font-size: 18px;">
        التاريخ {{ now()->format('Y-m-d') }}
    </div>
</div>
