const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/assets/js')
    .sass('resources/sass/style.scss', 'public/assets/css/style.css')
    //Jquery
    .scripts('node_modules/jquery/dist/jquery.js', 'public/assets/jquery/jquery.js')
    //Datatables
    .styles(
        [
            'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
            'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css'
        ],
        'public/assets/datatables/datatables.css'
    )
    .scripts(
        [
            'node_modules/datatables.net/js/jquery.dataTables.js',
            'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
            'node_modules/datatables.net-responsive/js/dataTables.responsive.js',
            'node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.js',
            'public/assets/datatables/traducao.js',
            'resources/js/datatables-datetime.js'
        ],
        'public/assets/datatables/datatables.js'
    )
    //Bootstrap
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets/bootstrap/bootstrap.js')
    //Select2
    .styles(
        [
            'node_modules/select2/dist/css/select2.css',
            'node_modules/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css'
        ],
        'public/assets/select2/css/select2.css'
    )
    .scripts('node_modules/select2/dist/js/select2.js', 'public/assets/select2/js/select2.js')
    //Bootstrap Datepicker
    .styles('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', 'public/assets/bootstrap-datepicker/bootstrap-datepicker.css')
    .scripts(
        [
            'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
            'node_modules/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js'
        ],
        'public/assets/bootstrap-datepicker/bootstrap-datepicker.js'
    )
    //Others
    .scripts('resources/js/waves.js', 'public/assets/js/waves.js')
    .scripts('resources/js/sidebarmenu.js', 'public/assets/js/sidebarmenu.js')
    .scripts('node_modules/sticky-kit/dist/sticky-kit.js', 'public/assets/sticky-kit/sticky-kit.js')
    .scripts('node_modules/jquery-sparkline/jquery.sparkline.js', 'public/assets/jquery-sparkline/jquery.sparkline.js')
    .scripts('resources/js/custom.js', 'public/assets/js/custom.js')
    .styles('node_modules/toastr/build/toastr.css', 'public/assets/toastr/css/toastr.css')
    .scripts('node_modules/toastr/toastr.js', 'public/assets/toastr/js/toastr.js')
    .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/assets/sweetalert/js/sweetalert.js')
    //Assets for View
    .js('resources/views/system/customers/customers.js', 'public/assets/views/customers/customers.js')
    .js('resources/views/system/employees/employees.js', 'public/assets/views/employees/employees.js')
    .js('resources/views/system/suppliers/suppliers.js', 'public/assets/views/suppliers/suppliers.js')
    .js('resources/views/system/financial/receipts/receipts.js', 'public/assets/views/financial/receipts/receipts.js')
    .js('resources/views/system/financial/payments/payments.js', 'public/assets/views/financial/payments/payments.js');