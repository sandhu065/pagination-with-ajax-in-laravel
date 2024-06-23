<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body will be populated by DataTables -->
        </tbody>
    </table>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    
    <!-- Include DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
      var pendingCatalogsTable;
$(document).ready(function() {
    // DataTable initialization
    const baseUrl = "{{ url('/') }}";
    pendingCatalogsTable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            tooltip:true,
            ajax: "{{ route('pagi') }}",
            paging: true, // Enable server-side pagination
            pageLength: 3, // Initial number of entries per page
            columns: [
                { name: 'First', // Give the name of <th scope="col">First</th>
                    render: function (data, type, row) {
                     console.log(row.Fname);
                      return row.Fname ?? 'NA';    
                    }
                },
                { name: 'Last', 
                    render: function (data, type, row) {
                      return row.Fname?? 'NA';    
                    }
                },
                {
                    name: 'Action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var action = '';
                    action += '<a href="#" class="btn btn-primary edit-userdata-btn" data-toggle="modal" data-target="#editUserDataModal" data-user-id="' + row.id + '">';
                    action += '<i class="bi bi-pencil"></i>';
                    action += '</a> ';
                    action += '<a href="#" class="btn btn-danger delete-user-btn" data-user-id="' + row.id + '">';
                    action += '<i class="bi bi-trash"></i>';
                    action += '</a> ';
                    action += '<a href="#" class="btn btn-warning change-password-btn" data-id="' + row.id + '" data-toggle="modal" data-target="#changePasswordModal">';
                    action += '<i class="bi bi-key"></i>';
                    action += '</a>';
                    return action;
                }
                }


            ],
            rowCallback: function (row, data) {
                $(row).addClass('row_status_'+data.id); // Add a CSS class to the row
            }
    });
});
    </script>
    
</body>
</html>
