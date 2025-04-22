<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8" />  
    <title>Registered Users</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />  
</head>  
<body>  

<div class="container mt-4">  
    <h4>Registered Users</h4>  

    <div class="card mt-3">  
        <div class="card-header bg-light">  
            <strong>REG USERS</strong>  
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
                        <th>Contact no</th>  
                        <th>DOB</th>  
                        <th>Address</th>  
                        <th>City</th>  
                        <th>Country</th>  
                        <th>Reg Date</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    <tr>  
                        <td>1</td>  
                        <td>Reyna Marie</td>  
                        <td>reynamarie.boyboy22@gmail.com</td>  
                        <td>9567833665</td>  
                        <td><!-- DOB value if available --></td>  
                        <td><!-- Address if available --></td>  
                        <td><!-- City if available --></td>  
                        <td><!-- Country if available --></td>  
                        <td>2025-02-23 12:13:07</td>  
                    </tr>  
                </tbody>  
                <tfoot class="bg-light">  
                    <tr>  
                        <th>#</th>  
                        <th>Name</th>  
                        <th>Email</th>  
                        <th>Contact no</th>  
                        <th>DOB</th>  
                        <th>Address</th>  
                        <th>City</th>  
                        <th>Country</th>  
                        <th>Reg Date</th>  
                    </tr>  
                </tfoot>  
            </table>  

            <div class="mt-2 small text-muted">  
                Showing 1 to 1 of 1 entries  
            </div>  

            <nav aria-label="Page navigation example">  
                <ul class="pagination pagination-sm justify-content-end mb-0">  
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>  
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>  
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>  
                </ul>  
            </nav>  
        </div>  
    </div>  
</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>  