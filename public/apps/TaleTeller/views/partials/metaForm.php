<section class="meta-form">
    <div>
        <label for="title"></label>
        <input type="text" id="title" name="title" placeholder="Title">
    </div>

    <div>
        <label for="keyword"></label>
        <input type="text" id="keyword" name="keyword" placeholder="Keyword">
    </div>

    <div>
        <label for="theme"></label>
        <select id="theme" name="theme">
            <option value="">Theme</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Sci-Fi">Sci-Fi</option>
            <option value="Romance">Romance</option>
            <option value="Horror">Horror</option>
            <option value="Adventure">Adventure</option>
        </select>

        <label for="steps"></label>
        <select id="steps" name="steps">
            <option value="">Steps</option>
            <?php for ($i = 5; $i <=15; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>
</section>
