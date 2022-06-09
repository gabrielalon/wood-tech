<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted text-light">
                    <small>{{ date('Y') }} &copy; {{ config('app.name') }}</small>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <p class="text-muted text-light">
                    <small>
                        Laravel: {{ app()->version() }}
                        PHP: {{ phpversion() }}
                        MySQL: {{ \Illuminate\Support\Facades\DB::selectOne('SHOW VARIABLES LIKE "version"')->Value }}
                    </small>
                </p>
            </div>
        </div>
    </div>
</footer>
