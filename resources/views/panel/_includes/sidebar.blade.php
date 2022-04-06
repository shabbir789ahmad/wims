<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <img src="{{ asset('assets/defaults/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">WIMS</span>
    </a>


    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/defaults/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-coffee nav-icon"></i>
                        <p>
                            Expenses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ route('expence.index') }}" class="nav-link"><i class="fas fa-coffee nav-icon"></i>
                                <p>All Expenses</p>
                            </a>
                        </li>

                 <li class="nav-item">
                    <a href="{{ route('expense.index') }}" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p class="ml-1">
                            Expense Type
                        </p>
                     </a>
                </li>
                    </ul>
                </li>
                @foreach (Auth::user()->getRoleNames() as $role) 
                @if($role=='admin')
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="@anchor('employees')" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Logo</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}" class="nav-link">
                                <i class="fa fa-balance-scale-right nav-icon"></i>
                                <p>Units</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                        <p>
                            Payment Reciveable
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ route('payment/recive') }}" class="nav-link"><i class="fab fa-cc-amazon-pay"></i>
                                <p>Recivable Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                        <p>
                            Payment Payable
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ route('payable.index') }}" class="nav-link"><i class="fab fa-cc-amazon-pay"></i>
                                <p>Payable Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('units.index') }}" class="nav-link">
                        <i class="fa fa-copyright nav-icon"></i>
                        <p>Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('brands.index') }}" class="nav-link">
                        <i class="fa fa-copyright nav-icon"></i>
                        <p>Brands</p>
                    </a>
                </li>
               <!--  <li class="nav-item">
                    <a href="{{ route('brands.index') }}" class="nav-link">
                        <i class="fa fa-copyright nav-icon"></i>
                        <p>Tax Collection</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Sub Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Suppliers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Products
                        </p>
                        
                    </a>
                </li>
              @endif
              @endforeach
               <li class="nav-item">
                    <a href="{{ route('return.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Invoices
                        </p>
                        
                    </a>
                </li>
              @foreach (Auth::user()->getRoleNames() as $role) 
                @if($role=='admin')

                
                 <li class="nav-item">
                    <a href="{{ route('barcode.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Barcode
                        </p>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-coffee nav-icon"></i>
                        <p>
                            Report
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                           Daily Report
                        </p>
                        
                    </a>
                </li>

                 <li class="nav-item">
                    <a href="{{ route('report.create') }}" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p class="ml-1">
                            Product Report
                        </p>
                     </a>
                </li>
                    </ul>
                </li>
                 
                <li class="nav-item">
                    <a href="{{ route('products.update.bulk') }}" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <p class="ml-1">
                            Bulk Update
                        </p>
                     </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.copy') }}" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <p class="ml-1">
                            Copy Product
                        </p>
                     </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p class="ml-1">
                            Stock
                        </p>
                     </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p class="ml-1">
                            Create User
                        </p>
                     </a>
                </li>
                @endif
                @endforeach
                <!-- <li class="nav-item">
                    <a href="{{ route('credentials.index') }}" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p class="ml-1">
                            Email Data
                        </p>
                     </a>
                </li> -->
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-shopping-cart"></i>
                        <p>
                            Sale
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="@anchor('employees')" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Pos</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('pos.index') }}" class="nav-link">
                                <i class="fa fa-balance-scale-right nav-icon"></i>
                                <p>Pos</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>

    </div>

</aside>