
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <h2> User Statistics</h2>
        <table border="1">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Visit Count</th>
                <th>Last Visit</th>
            </tr>
            <?php while ($user = mysqli_fetch_assoc($query_users)): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['visit_count'] ?></td>
                    <td><?= $user['last_visit'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <h2>📩 Contact Messages</h2>
        <table border="1">
            <tr>
                <th>Sender Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Sent At</th>
            </tr>
            <?php while ($contact = mysqli_fetch_assoc($query_contacts)): ?>
                <tr>
                    <td><?= htmlspecialchars($contact['name']) ?></td>
                    <td><?= htmlspecialchars($contact['email']) ?></td>
                    <td><?= htmlspecialchars($contact['phone']) ?></td>
                    <td><?= htmlspecialchars($contact['message']) ?></td>
                    <td><?= $contact['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>