<?php
$questions = get_random_questions();
?>

<section id="questions-section">
    <?php foreach ($questions as $index => $question): ?>
        <p class="question-paragraph <?php echo ($index % 2 === 0) ? 'even' : 'odd'; ?>" 
           data-question="<?php echo htmlspecialchars(json_encode($question), ENT_QUOTES); ?>">
            <?php echo htmlspecialchars($question['body']); ?>
        </p>
    <?php endforeach; ?>
</section>

<style>
    .question-paragraph {
        margin-left: 10px;
        margin-right: 10px;
    }
    
    .question-paragraph.odd {
        background: #ffcccb;
    }
    
    .question-paragraph.even {
        background: #ff0000;
    }
</style>

<script>
    document.querySelectorAll('.question-paragraph').forEach(paragraph => {
        paragraph.addEventListener('mouseenter', function() {
            this.style.fontWeight = 'bold';
            this.style.cursor = 'wait';
        });
        
        paragraph.addEventListener('mouseleave', function() {
            this.style.fontWeight = 'normal';
        });
        
        paragraph.addEventListener('click', function() {
            const questionPopup = document.getElementById('question-popup');
            if (questionPopup) {
                questionPopup.style.visibility = 'visible';
                const questionData = JSON.parse(this.getAttribute('data-question'));
                questionPopup.setAttribute('data-question', JSON.stringify(questionData));
                if (typeof questionPopup.updateDatasource === 'function') {
                    questionPopup.updateDatasource(questionData);
                }
            }
        });
    });
</script>
