<div>

    <!-- TÍTULO -->
    <div style="margin-bottom:40px; text-align:center; color:#374151;">
        <h1 style="font-size:35px; font-weight:800; color:green;">
            <i class="fas fa-file-export" style="margin-right:10px; color:green;"></i>
            Generación de Reportes
        </h1>
        <p style="color:#4b5563; margin-top:10px; font-size:18px;">
            Selecciona una sección y exporta la información
        </p>
    </div>

    <!-- CONTENEDOR -->
    <div style="
        max-width:900px;
        margin:0 auto;
        background:#ffffff;
        border-radius:25px;
        padding:40px;
        border:1px solid #e5e7eb;
        box-shadow:0px 8px 20px rgba(0,0,0,0.08);
    ">

        <form id="formReporte" method="POST" action="{{ route('admin.reportes.generar') }}">
            @csrf

            <!-- SECCIONES -->
            <div style="margin-bottom:40px; text-align:center;">

                <label style="font-size:26px; font-weight:700; color:#111827; display:block; margin-bottom:25px;">
                    <i class="fas fa-folder-open" style="margin-right:10px; color:#4f46e5;"></i>
                    Sección del reporte
                </label>

                <div style="
                    display:grid;
                    grid-template-columns:repeat(2,1fr);
                    gap:25px;
                ">

                    @foreach($sections as $s)

                    <div class="section-option"
                         data-section="{{ $s['id'] }}"
                         onclick="selectSection('{{ $s['id'] }}', this)"
                         style="
                            border:2px solid #d1d5db;
                            border-radius:20px;
                            padding:25px;
                            cursor:pointer;
                            text-align:center;
                            background:#ffffff;
                            transition:0.25s;
                            box-shadow:0px 2px 5px rgba(0,0,0,0.08);
                         ">

                        <!-- ICONO -->
                        <div class="section-icon" style="
                            margin:0 auto 12px auto;
                            width:65px;
                            height:65px;
                            border-radius:50%;
                            background:#dcfce7;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            transition:0.25s;
                        ">
                            <i class="fas fa-{{ $s['icono'] }}"
                               style="font-size:22px; color:#16a34a; transition:0.25s;">
                            </i>
                        </div>

                        <!-- TEXTO -->
                        <span style="
                            font-size:18px;
                            font-weight:600;
                            color:#1f2937;
                        ">
                            {{ $s['nombre'] }}
                        </span>

                    </div>

                    @endforeach
                </div>

                <!-- input oculto -->
                <input type="hidden" name="tipo_reporte" id="tipoReporte">

                <p id="errorSeccion" style="color:red; font-size:14px; margin-top:10px; display:none;">
                     Selecciona una sección antes de continuar.
                </p>
            </div>

            <!-- BOTONES -->
            <div style="
                display:flex;
                flex-direction:column;
                gap:15px;
                justify-content:center;
                align-items:center;
            ">

                <button type="button"
                        onclick="submitForm('pdf')"
                        style="
                            background:#dc2626;
                            color:white;
                            font-weight:700;
                            padding:14px 40px;
                            border-radius:12px;
                            border:none;
                            font-size:16px;
                            width:250px;
                            cursor:pointer;
                            transition:0.2s;
                        "
                        onmouseover="this.style.background='#b91c1c'"
                        onmouseout="this.style.background='#dc2626'">
                    <i class="fas fa-file-pdf" style="margin-right:8px; font-size:20px;"></i>
                    Exportar PDF
                </button>

                <button type="button"
                        onclick="submitForm('excel')"
                        style="
                            background:#16a34a;
                            color:white;
                            font-weight:700;
                            padding:14px 40px;
                            border-radius:12px;
                            border:none;
                            font-size:16px;
                            width:250px;
                            cursor:pointer;
                            transition:0.2s;
                        "
                        onmouseover="this.style.background='#15803d'"
                        onmouseout="this.style.background='#16a34a'">
                    <i class="fas fa-file-excel" style="margin-right:8px; font-size:20px;"></i>
                    Exportar Excel
                </button>

            </div>

            <input type="hidden" name="formato" id="formatoInput">

        </form>

    </div>
</div>


