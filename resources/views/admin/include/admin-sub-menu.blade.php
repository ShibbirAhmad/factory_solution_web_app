<div id="compact_submenuSidebar" class="submenu-sidebar">


    {{-- Home Sub Menu start --}}
    <div class="submenu" id="dashboard">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('dashboard') }}"> Dashboard </a>
            </li>
        </ul>
    </div>
    {{-- Home Sub Menu end --}}

    <div class="submenu" id="app">
        <ul class="submenu-list" data-parent-element="#app">
            <li> <a href="{{ route('category.add') }}"> Add/New Category </a> </li>
            <li> <a href="{{ route('unit.add') }}"> Add/New Unit </a> </li>
            <li> <a href="{{ route('designation.add') }}"> Add/New Designation </a> </li>
            <li> <a href="{{ route('department.add') }}"> Add/New Department </a> </li>
            <li> <a href="{{ route('subDepartment.add') }}"> Add/New Sub Department </a> </li>
            <li> <a href="{{ route('paymentMethod.add') }}"> Add/New Payment Method </a> </li>
            <li> <a href="{{ route('color.add') }}"> Add/New Color </a> </li>
            <li> <a href="{{ route('client.create') }}"> Add/New Client </a> </li>
            <li> <a href="{{ route('attribute.index') }}"> Attributes(Size, Color) </a> </li>
            <li> <a href="{{ route('variant.index') }}"> Variant(M,L,Black,Navy) </a> </li>
        </ul>
    </div>



    {{-- Employee start --}}
    <div class="submenu" id="hr">
        <ul class="submenu-list" data-parent-element="#app">
            <li> <a href="{{ route('employee.add') }}"> Add/New Employee </a></li>
            <li> <a href="{{ route('attendance.add') }}"> Daily Attendance </a></li>
        </ul>
    </div>
    {{-- Employee end --}}
    {{-- Purcahse Sub Menu start --}}
    <div class="submenu" id="purchase">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('purchase.create') }}"> Add/New Purchase </a>
            </li>
            <li>
                <a href="{{ route('purchase.index') }}"> Manage Purchase </a>
            </li>
        </ul>
    </div>
    {{-- Purchase Sub Menu end --}}

    {{-- Due's Receive Sub Menu start --}}
    <div class="submenu" id="due_receive">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('dueReceive.add') }}"> Add/New Due </a>
            </li>
        </ul>
    </div>
    {{-- Due's Receive Sub Menu end --}}

    {{-- Supplier Sub Menu start --}}
    <div class="submenu" id="supplier">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('supplier.create') }}"> Add/New Supplier </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}"> Manage Supplier </a>
            </li>
        </ul>
    </div>
    {{-- Supplier Sub Menu end --}}

    {{-- Client Order Start --}}
    <div class="submenu" id="clientOrder">
        <ul class="submenu-list" data-parent-element="#app">
            <li> <a href="{{ route('order.add') }}"> Add/New Production </a> </li>
            <li> <a href="{{ route('order.list') }}"> Manage Productions </a> </li>

        </ul>
    </div>
    {{-- Client Order End --}}

    {{-- Design start --}}
    <div class="submenu" id="design">
        <ul class="submenu-list" data-parent-element="#app">
            <li> <a href="{{ route('prototype.add') }}"> Add/New Design </a> </li>
            <li> <a href="{{ route('prototype.add') }}"> Manage Designs </a> </li>
        </ul>
    </div>

    {{-- Design end --}}

    {{-- Design start --}}
    <div class="submenu" id="products">
        <ul class="submenu-list" data-parent-element="#app">
            <li> <a href="{{ route('product.add') }}"> Add/New Product </a> </li>
            <li> <a href="{{ route('product.add') }}"> Manage Products </a> </li>
        </ul>
    </div>

    {{-- Design end --}}

    {{-- Warehouse Sub Menu start --}}
    <div class="submenu" id="warehouse">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('warehouse.add') }}"> Add/New Warehouse </a>
            </li>
            <li>
                <a href="{{ route('warehouse.products') }}"> Warehouse Products </a>
            </li>
        </ul>
    </div>
    {{-- Warehouse Sub Menu end --}}



    {{-- sales Sub Menu start --}}
    <div class="submenu" id="sales">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('sale.create') }}"> Add/New Sale </a>
            </li>
            <li>
                <a href="{{ route('sale.index') }}"> Mange Sale </a>
            </li>
        </ul>
    </div>
    {{-- sales Sub Menu end --}}



    {{-- admin Sub Menu start --}}
    <div class="submenu" id="admin">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('admin.index') }}"> Add/New Admin </a>
            </li>
        </ul>
    </div>
    {{-- admin Sub Menu end --}}


    {{-- clients Sub Menu start --}}
    <div class="submenu" id="clients">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('client.create') }}"> Manage Clients </a>
            </li>
        </ul>
    </div>
    {{-- clients Sub Menu end --}}


    {{-- cashbook Sub Menu start --}}
    <div class="submenu" id="cashbook">
        <ul class="submenu-list" data-parent-element="#app">
            <li>
                <a href="{{ route('cashbook_income') }}">  Incomes/Credits </a>
            </li>
            <li>
                <a href="{{ route('cashbook_pay_off') }}"> Pay Off/Debits </a>
            </li>
        </ul>
    </div>
    {{-- cashbook Sub Menu end --}}



</div>
