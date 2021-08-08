let contributorTable;
document.addEventListener("DOMContentLoaded", function() {
    contributorTable = $('#contributor-table').DataTable({
        "ajax": {
            "url": `${baseUrl}/contributor_list`,
            "dataSrc": ""
        },
        "buttons": [],
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email"},
            { "data": "company_name" },
            { "data": "job_title" },
            {"data": "id",
                "render": function(data, type, row) {
                    // return `<div>
                    //     <button onclick="deleteAnImage(${data})" type="button" class="btn btn-danger action-icon"><i class="fa fa-trash-o"></i></button>
                    //     <button onclick="editImage(${data})" type="button" class="btn btn-danger action-icon"><i class="fa fa-edit"></i></button>
                    // </div>`;
                    return row.active_status === 0
                        ? `<button onclick="approveContributor(${data})"
                            class="btn btn-sm btn-success">Approve</button>`
                        : `<button class="btn btn-sm btn-success disabled">Approve</button>`;
                }}

        ]
    });
});

function approveContributor(contributorId) {
    swal({
        title: "Are you sure?",
        text: "You are approving this contributor!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willProceed) => {
            if (willProceed) {
                let formData = new FormData();
                formData.append('contributorId', contributorId);
                fetch(`${baseUrl}/approve_contributor`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(res => {
                        if(res.status === 200){
                            swal("Contributor has been approved!", {
                                icon: "success",
                            });
                            contributorTable.ajax.reload();
                        } else {
                            swal("Contributor is not approved!");
                        }

                    });
            } else {
                swal("Contributor is not approved!");
            }
        });
}
