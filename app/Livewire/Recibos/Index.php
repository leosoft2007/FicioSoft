<?php

namespace App\Livewire\Recibos;

use App\Models\Recibo;
use Illuminate\View\View;
use Livewire\Component;


class Index extends Component
{



    // En tu Controller o en el método render() de tu componente Livewire
    public $columnsRecibo = [
        ['field' => 'id_long', 'label' => 'Número', 'format' => null, 'sortable' => false, 'show_in_mobile' => true, 'searchable' => false,  'format' => 'fondo', 'fondo_palette' => 'gris'],
        ['field' => 'paciente.apellido', 'label' => 'Apellido', 'visible' => false],
        [
            'field' => 'paciente.nombre', // Tu campo principal de búsqueda
            'label' => 'Nombre',
            'searchable' => true,
            'format' => 'nombre',
            'show_in_mobile' => true,
            // Para mostrar "Apellido Nombre"
            'concat_fields' => ['paciente.apellido', 'paciente.nombre'],
            'concat_separator' => ' ',
            'search_fields' => ['paciente.nombre', 'paciente.apellido'],
        ],
        ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false, 'format' => 'date', 'show_in_mobile' => true, 'filter' => 'range_date',],
        ['field' => 'valor', 'label' => 'Valor', 'searchable' => true, 'format' => 'money', 'show_in_mobile' => true, 'filter' => 'range_number'],
        [
            'field' => 'formadepago',
            'label' => 'Forma de Pago',
            'format' => 'badge',
            'badge_map' => [
                'efectivo' => 'verde',
                'tarjeta' => 'azul',
                'transferencia' => 'indigo',
                'bizum' => 'amarillo',
            ],
            'icon' => '<svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>',
            'show_in_mobile' => true, 'filter' => 'select', 'options' => ['efectivo', 'tarjeta', 'cheque']],
    ];
    public $columnsFactura = [
        ['field' => 'numero_factura', 'label' => 'Número', 'format' => null, 'show_in_mobile' => true, 'searchable' => true,  'format' => 'fondo', 'fondo_palette' => 'gris'],
        ['field' => 'paciente.apellido', 'label' => 'Apellido', 'visible' => false],
        [
            'field' => 'paciente.nombre', // Tu campo principal de búsqueda
            'label' => 'Nombre',
            'searchable' => true,
            'format' => 'nombre',
            'show_in_mobile' => true,
            // Para mostrar "Apellido Nombre"
            'concat_fields' => ['paciente.apellido', 'paciente.nombre'],
            'concat_separator' => ' ',
            'search_fields' => ['paciente.nombre', 'paciente.apellido'],
        ],
        ['field' => 'fecha', 'label' => 'Fecha', 'searchable' => false, 'format' => 'date', 'show_in_mobile' => true, 'filter' => 'range_date'],
        ['field' => 'total', 'label' => 'Total', 'searchable' => true, 'format' => 'money', 'show_in_mobile' => true, 'filter' => 'range_number'],
        ['field' => 'metodo_pago',
            'label' => 'Forma de Pago',
            'format' => 'badge',
            'badge_map' => [
                'efectivo' => 'verde',
                'tarjeta' => 'azul',
                'transferencia' => 'indigo',
                'bizum' => 'amarillo',
            ],
            'icon' => '<svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none"><path d="M3 10H21M7 15H8M12 15H13M6 8H18C19.1046 8 20 8.89543 20 10V16C20 17.1046 19.1046 18 18 18H6C4.89543 18 4 17.1046 4 16V10C4 8.89543 4.89543 8 6 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" /></svg>',
            'show_in_mobile' => true,
            'filter' => 'select',
            'options' => ['efectivo', 'tarjeta', 'transferencia', 'bizum'], 
        ],
        ['field' => 'estado', 'label' => 'Estado', 'format' => 'badge', 'badge_map' => ['pendiente' => 'rojo', 'pagada' => 'verde', 'cancelada' => 'gris'], 'show_in_mobile' => true, 'filter' => 'select', 'options' => ['pendiente', 'pagada', 'cancelada']],
    ];

    public $columnsPaciente = [
            [
                'field' => 'nombre', // Tu campo principal de búsqueda
                'label' => 'Nombre',
                'searchable' => true,
                'format' => 'nombre',
                'show_in_mobile' => true,
                // Para mostrar "Apellido Nombre"
                'concat_fields' => ['apellido', 'nombre'],
                'concat_separator' => ' ',
                'search_fields' => ['nombre', 'apellido'],
        ],
        ['field' => 'apellido', 'label' => 'Apellido', 'visible' => false],
        // Puedes ocultar las columnas individuales si quieres, o mostrarlas junto al contacto
        // ['field' => 'telefono', 'label' => 'Teléfono', ...],
        // ['field' => 'email', 'label' => 'Email', ...],
        [
            'field' => 'telefono', // El nombre puede ser cualquier string, no hay que existir en la BD
            'label' => 'Contacto',
            'format' => 'contacto',
            'email_field' => 'email',
            'telefono_field' => 'telefono',
            'show_in_mobile' => true,
            'sortable' => false,
            'searchable' => true,
            'search_fields' => ['email', 'telefono'],
        ],
        ['field' => 'estado_paciente', 'label' => 'Estado', 'searchable' => false, 'format' => 'badge',
        'badge_map' => ['activo' => 'verde', 'inactivo' => 'gris', 'suspendido' => 'rojo'], 'show_in_mobile' => true,
        'filter' => 'select', 'options' => ['activo', 'inactivo', 'suspendido']],

    ];

    public $columnsProfesional = [
        ['field' => 'color', 'label' => '#', 'searchable' => false, 'format' => 'color', 'show_in_mobile' => true, 'sortable' => false],
        [
            'field' => 'nombre', // Tu campo principal de búsqueda
            'label' => 'Nombre',
            'searchable' => true,
            'format' => 'nombre',
            'show_in_mobile' => true,
            // Para mostrar "Apellido Nombre"
            'concat_fields' => ['apellido', 'nombre'],
            'concat_separator' => ' ',
            'search_fields' => ['nombre', 'apellido'],
        ],
        ['field' => 'apellido', 'label' => 'Apellido', 'visible' => false],
        ['field' => 'especialidad.nombre', 'label' => 'Especialidad', 'searchable' => true, 'format' => 'fondo', 'fondo_palette' => 'indigo','show_in_mobile' => true],
        [
            'field' => 'telefono', // El nombre puede ser cualquier string, no hay que existir en la BD
            'label' => 'Contacto',
            'format' => 'contacto',
            'email_field' => 'email',
            'telefono_field' => 'telefono',
            'show_in_mobile' => true,
            'sortable' => false,
            'searchable' => true,
            'search_fields' => ['email', 'telefono'],
        ],


    ];

    public function render(): View
    {
        $recibos = Recibo::all();
        $cantidad = $recibos->count();


        return view('livewire.recibo.index', compact('recibos', 'cantidad'));
    }

    public function delete(Recibo $recibo)
    {
        $recibo->delete();

        return $this->redirectRoute('recibos.index', navigate: true);
    }
}
