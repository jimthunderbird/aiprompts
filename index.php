
<?php
function component_questions_table_datasource() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    $shuffled = $questions;
    shuffle($shuffled);
    return array_slice($shuffled, 0, 2);
}

function get_random_questions() {
    $json = file_get_contents('questions.json');
    $questions = json_decode($json, true);
    shuffle($questions);
    return array_slice($questions, 0, 2);
}

$questionsTableData = component_questions_table_datasource();
$questionsListData = get_random_questions();
?>

<table id="questions-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>QUESTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questionsTableData as $index => $question): ?>
        <tr data-row="<?php echo $index + 1; ?>">
            <td data-col="1" data-value="<?php echo htmlspecialchars($question['id']); ?>"><?php echo htmlspecialchars($question['id']); ?></td>
            <td data-col="2" data-value="<?php echo htmlspecialchars($question['body']); ?>"><?php echo htmlspecialchars($question['body']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<section id="questions-list">
    <?php foreach ($questionsListData as $index => $question): ?>
    <p class="<?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>" data-question="<?php echo htmlspecialchars($question['body']); ?>">
        <?php echo htmlspecialchars($question['body']); ?>
    </p>
    <?php endforeach; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.querySelector('#questions-table tbody');
    if (tableBody) {
        tableBody.addEventListener('click', function(e) {
            const cell = e.target.closest('td');
            if (cell) {
                const row = cell.closest('tr');
                const rowNumber = row.dataset.row;
                const colNumber = cell.dataset.col;
                const questionBody = cell.dataset.value;
                alert('question details: ' + questionBody + ' (' + rowNumber + ', ' + colNumber + ')');
            }
        });

        const cells = tableBody.querySelectorAll('td');
        cells.forEach(cell => {
            cell.addEventListener('mouseenter', function() {
                this.style.fontWeight = 'bold';
            });
            cell.addEventListener('mouseleave', function() {
                this.style.fontWeight = 'normal';
            });
        });
    }

    const paragraphs = document.querySelectorAll('#questions-list p');
    paragraphs.forEach(p => {
        p.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
        });
        p.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
    });
});
</script>

<style>
#questions-table {
    background: lightyellow;
    border: 3px solid gold;
    border-collapse: collapse;
    width: 100%;
}

#questions-table thead th {
    background: lightyellow;
    text-align: left;
    padding: 8px;
    border: 1px solid gold;
}

#questions-table tbody td {
    background: wheat;
    text-align: center;
    padding: 8px;
    border: 1px solid gold;
    cursor: pointer;
}

#questions-list p {
    margin-left: 10px;
    margin-right: 10px;
    padding: 10px;
    cursor: pointer;
}

#questions-list p.odd {
    background: lightcoral;
}

#questions-list p.even {
    background: red;
    color: white;
}

@media (max-width: 768px) {
    #questions-table {
        font-size: 14px;
    }
    
    #questions-table thead th,
    #questions-table tbody td {
        padding: 6px;
    }
    
    #questions-list p {
        font-size: 14px;
        margin-left: 5px;
        margin-right: 5px;
        padding: 8px;
    }
}
</style>


