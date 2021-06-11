@if ($errors->any())
    <div class="errors-container">
        <div class="alert alert-danger">
            <ul class="errors-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} <strong class="close-alert">X</strong></li>
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        const errorCloseBtns = document.querySelectorAll('.errors-list > li > .close-alert');

        errorCloseBtns.forEach((closeBtn) => {
            closeBtn.addEventListener('click', () => {
                closeBtn.closest('li').remove();
            })
        });
    </script>
@endif
