<!-- modal.php -->
<div class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <!-- Título do modal -->
        <h2><?= isset($modal_title) ? $modal_title : 'Modal Title'; ?></h2>

        <!-- Mensagem de erro -->
        <?php if (isset($error_message)) : ?>
            <p class="error"><?= $error_message; ?></p>
        <?php endif; ?>

        <!-- Formulário -->
        <form action="<?= isset($modal_action_url) ? $modal_action_url : ''; ?>" method="POST">
            <?= isset($modal_form_content) ? $modal_form_content : ''; ?>

            <div class="form-buttons">
                <button type="button" class="cancel-button" onclick="closeModal()">Cancel</button>
                <button type="submit" class="submit-button"><?= isset($modal_button_text) ? $modal_button_text : 'Submit'; ?></button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
    }
</style>

<script>
    function openModal() {
        document.querySelector('.modal').style.display = "block";
    }

    function closeModal() {
        document.querySelector('.modal').style.display = "none";
    }

    // Close modal when clicked outside
    window.onclick = function(event) {
        if (event.target == document.querySelector('.modal')) {
            closeModal();
        }
    }
</script>
