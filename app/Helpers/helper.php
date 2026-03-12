<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('message')) {
    function message()
    {
        $html = '';

        if (Session::has('success')) {
            $html = '
        <div class="d-flex justify-content-center mb-2">
            <div class="alert alert-success text-center" style="width: 280px;">
                ' . Session::get('success') . '
            </div>
        </div>';
        }

        if (Session::has('error')) {
            $html = '
        <div class="d-flex justify-content-center mb-2">
            <div class="alert alert-danger text-center" style="width: 280px;">
                ' . Session::get('error') . '
            </div>
        </div>';
        }

        return $html;
    }
}

if (!function_exists('logoutModal')) {
    function logoutModal($logoutRoute)
    {
        return '
        <form id="logoutForm" method="POST" action="' . route($logoutRoute) . '">
            ' . csrf_field() . '
            <button type="button" class="btn btn-outline-light btn-sm" 
                data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout
            </button>
        </form>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger" id="confirmLogout">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("confirmLogout").addEventListener("click", function () {
                    document.getElementById("logoutForm").submit();
                });
            });
        </script>
        ';
    }
}

?>