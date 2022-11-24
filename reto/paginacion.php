<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>pagination example</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
</head>
<body>

<div>
    <section>
        <div id="container"></div>
        <div id="pagination"></div>
    </section>
</div>

<script>
    $(function () {
        let container = $('#pagination');
        container.pagination({
            dataSource: [
{number: "Number 1"},
{number: "Number 2"},
{number: "Number 3"},
{number: "Number 4"},
{number: "Number 5"},
{number: "Number 6"},
{number: "Number 7"},
{number: "Number 8"},
{number: "Number 9"},
{number: "Number 10"},
{number: "Number 11"},
{number: "Number 12"},
{number: "Number 13"},
{number: "Number 14"},
{number: "Number 15"},
{number: "Number 16"},
{number: "Number 17"},
            ],
            pageSize: 5,
            callback: function (data, pagination) {
                var dataHtml = '<ul>';

                $.each(data, function (index, item) {
                    dataHtml += '<li>' + item.number + '</li>';
                });

                dataHtml += '</ul>';

                $("#container").html(dataHtml);
            }
        })
    })
</script>
</body>
</html>
