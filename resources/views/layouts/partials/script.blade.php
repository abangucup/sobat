<!-- Required vendors -->
<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>

{{-- MENGGANGGU ALERT --}}
{{-- <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/select2/js/select2.full.min.js') }}"></script> --}}


<!-- Apex Chart -->
<script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script>
<!-- Chart piety plugin files -->
<script src="{{ asset('assets/vendor/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<!--swiper-slider-->
<script src="{{ asset('assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

<!-- Date-picker -->
<script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script>
<script src="{{ asset('assets/vendor/wow-master/dist/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>

<script src="{{ asset('assets/js/deznav-2-init.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/js/demo-2.js') }}"></script>
<script src="{{ asset('assets/js/styleSwitcher.js') }}"></script>

{{-- PICKER DATE, COLOR, CLOCK --}}
{{-- Material Picker --}}
<script src="{{ asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}">
</script>
<script src="{{ asset('assets/js/plugins-init/material-date-picker-init.js') }}"></script>
<!-- pickdate -->
<script src="{{ asset('assets/vendor/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('assets/vendor/pickadate/picker.date.js') }}"></script>

<!-- Daterangepicker -->
<script src="{{ asset('assets/js/plugins-init/bs-daterange-picker-init.js') }}"></script>
<!-- Clockpicker init -->
<script src="{{ asset('assets/js/plugins-init/clock-picker-init.js') }}"></script>
<!-- asColorPicker init -->
<script src="{{ asset('assets/js/plugins-init/jquery-asColorPicker.init.js') }}"></script>
<!-- Material color picker init -->
<script src="{{ asset('assets/js/plugins-init/material-date-picker-init.js') }}"></script>
<!-- Pickdate -->
<script src="{{ asset('assets/js/plugins-init/pickadate-init.js') }}"></script>

<script>
    $(function () {
            $('#datetimepicker').datetimepicker({
                inline: true,
            });
        });
        
        $(document).ready(function(){
            $(".booking-calender .fa.fa-clock-o").removeClass(this);
            $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
        });
</script>

<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            const passwordInput = $('#inputPassword');
            const passwordFieldType = passwordInput.attr('type');

            if (passwordFieldType === 'password') {
                passwordInput.attr('type', 'text');
                $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordInput.attr('type', 'password');
                $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>

{{-- Format Harga --}}
<script>
    // INPUT HARGA BERUPA ANGKA
    document.addEventListener('input', function (e) {
        if (e.target && e.target.id === 'harga') {
            const input = e.target;
            const value = input.value.replace(/[^0-9]/g, ''); // Hanya menerima digit
            input.value = formatCurrency(value);
        }
    });

    // MATA UANG
    function formatCurrency(value) {
        if (value.length === 0) return '';
        
        const number = parseInt(value);
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(number);

        return formatted.replace('IDR', '');

    }
</script>