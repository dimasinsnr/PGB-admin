<div class="custom-dropdown" id="customDropdown">
    <button class="custom-dropdown-toggle" style=" border: none; background-color: transparent" type="button" onclick="toggleCustomDropdown(this)" aria-haspopup="true" aria-expanded="false" onclick="onAction()">
        <i class="bi bi-three-dots" style="font-size: 20px;"></i>
    </button>
    <div class="custom-dropdown-menu" aria-labelledby="customDropdown" onclick="closeCustomDropdowns(event)">
        <a class="dropdown-item" href="javascript:void(0)" onclick="onEdit('{{ strval($unit_latihan_id) }}', '{{ strval($unit_latihan_nama) }}')">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Edit') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onDelete('{{ strval($unit_latihan_id) }}')">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Delete') }}
        </a>
    </div>
</div>

{{-- <nav class="navbar p-0">
    <ul class="navbar-nav">
        <li class="nav-item dropdown no-arrow">
            <a href="javascript:;" id="opDD" class="btn btn-sm btn-icon" data-toggle="dropdown">
                <i class="bi bi-three-dots" style="font-size: 20px;"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in static" style="z-index: 2" aria-labelledby="opDD">
                <a class="dropdown-item" href="javascript:void(0)" onclick="onEdit('{{ strval($unit_latihan_id) }}', '{{ strval($unit_latihan_nama) }}')">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Edit') }}
                </a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="onDelete('{{ strval($unit_latihan_id) }}')">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Delete') }}
                </a>
            </div>
        </li>
    </ul>
</nav> --}}
