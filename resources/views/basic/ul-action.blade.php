<div class="custom-dropdown" id="customDropdown">
    <button class="custom-dropdown-toggle" style=" border: none; background-color: transparent" type="button" onclick="toggleCustomDropdown(this)" aria-haspopup="true" aria-expanded="false" onclick="onAction()">
        <i class="bi bi-three-dots" style="font-size: 20px;"></i>
    </button>
    <div class="custom-dropdown-menu" aria-labelledby="customDropdown" onclick="closeCustomDropdowns(event)">
        <a class="dropdown-item" href="javascript:void(0)" onclick="onEdit('{{ strval($id) }}', '{{ strval($name) }}')">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Edit') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onDelete('{{ strval($id) }}')">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Delete') }}
        </a>
    </div>
</div>