<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8" />  
    <title>Manage Contact Us Queries</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />  
</head>  
<body>  

<div class="container mt-4">  
    <h4>Manage Contact Us Queries</h4>  

    <div class="card mt-3">  
        <div class="card-header bg-light">  
            <strong>USER QUERIES</strong>  
        </div>  
        <div class="card-body p-3">  
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">  
                <div>  
                    Show   
                    <select id="entries" class="form-select form-select-sm d-inline-block" style="width: auto;">  
                        <option selected>10</option>  
                        <option>25</option>  
                        <option>50</option>  
                        <option>100</option>  
                    </select>   
                    entries  
                </div>  
                <div>  
                    Search: <input type="search" class="form-control form-control-sm d-inline-block" style="width: auto;">  
                </div>  
            </div>  

            <table class="table table-bordered table-striped table-hover table-sm mb-0">  
                <thead class="table-light">  
                    <tr>  
                        <th style="width: 5%;">#</th>  
                        <th>Name</th>  
                        <th>Email</th>  
                        <th>Contact No</th>  
                        <th>Message</th>  
                        <th>Posting date</th>  
                        <th>Action</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    <tr>  
                        <td colspan="7" class="text-center">No data available in table</td>  
                    </tr>  
                </tbody>  
                <tfoot class="bg-light">  
                    <tr>  
                        <th>#</th>  
                        <th>Name</th>  
                        <th>Email</th>  
                        <th>Contact No</th>  
                        <th>Message</th>  
                        <th>Posting date</th>  
                        <th>Action</th>  
                    </tr>  
                </tfoot>  
            </table>  

            <div class="mt-2 small text-muted">  
                Showing 0 to 0 of 0 entries  
            </div>  

            <nav aria-label="Page navigation example">  
                <ul class="pagination pagination-sm justify-content-end mb-0">  
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>  
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>  
                </ul>  
            </nav>  
        </div>  
    </div>  
</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>  