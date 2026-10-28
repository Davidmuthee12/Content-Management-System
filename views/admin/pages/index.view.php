<h1>Admin: Manage Pages</h1>

<table style="width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pages AS $page): ?>
            <tr>
                <td><?php echo e($page->id); ?></td>
                <td><?php echo e($page->title); ?></td>
                <td>
                    <form method="POST" action="index.php?<?php echo http_build_query(['route' => 'admin/pages/delete']); ?>">
                        <input type="hidden" name="id" value="<?php echo e($page->id); ?>">
                        <input type="submit" value="Delete!">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create Page</a>