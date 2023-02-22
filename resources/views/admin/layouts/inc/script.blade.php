<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin') }}/assets/vendor/libs/jquery/jquery.js"></script>
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/popper/popper.js"></script> --}}
<script src="{{ asset('admin') }}/assets/vendor/js/bootstrap.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/node-waves/node-waves.js"></script> --}}

{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/hammer/hammer.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/i18n/i18n.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script> --}}

<script src="{{ asset('admin') }}/assets/vendor/libs/select2/select2.js"></script>
<script src="{{ asset('admin') }}/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('admin') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables/jquery.dataTables.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-buttons/buttons.html5.js"></script> --}}
{{-- <script src="{{ asset('admin') }}/assets/vendor/libs/datatables-buttons/buttons.print.js"></script> --}}
<script src="{{ asset('admin') }}/assets/vendor/libs/toastr/toastr.js"></script>
{!! Toastr::message() !!}

<script src="{{ asset('admin') }}/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="{{ asset('admin') }}/assets/js/extended-ui-sweetalert2.js"></script>

<!-- Main JS -->
<script src="{{ asset('admin') }}/assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('admin') }}/assets/js/dashboards-ecommerce.js"></script>
<script src="{{ asset('admin') }}/assets/js/forms-selects.js"></script>
<script src="{{ asset('admin') }}/assets/js/ui-toasts.js"></script>


@stack('admin_scipt')
