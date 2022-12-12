<?= $this->extend("template") ?>

<?= $this->section("title") ?>
Starter
<?= $this->endSection() ?>

<?= $this->section("breadcrumb") ?>
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active">Starter Page</li>
<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="card">
    <div class="card-body">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates nulla, quisquam ex corporis, error animi voluptatibus ipsum eaque accusamus vitae debitis, rem magnam libero? Ratione nihil nisi nemo temporibus facere.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates nulla, quisquam ex corporis, error animi voluptatibus ipsum eaque accusamus vitae debitis, rem magnam libero? Ratione nihil nisi nemo temporibus facere.
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("script") ?>

<script type="text/javascript">
alert("Hallo")
</script>

<?= $this->endSection() ?>