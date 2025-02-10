<?php
include __DIR__ . '/../core/database.php';

$tableName = $_POST['table_name'] ?? '';
$whereClause = $_POST['where_clause'] ?? '';
$limit = (int)($_POST['limit'] ?? 100);
$offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
global $conn;

try {
    // Fetch total record count
    $countQuery = "SELECT COUNT(*) as total FROM $tableName";
    if (!empty($whereClause)) {
        $countQuery .= " WHERE $whereClause";
    }
    $countStmt = $conn->query($countQuery);
    $totalCount = (int)$countStmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Adjust query based on limit (0 means unlimited records)
    if ($limit === 0) {
        $query = "SELECT * FROM $tableName";
    } else {
        $query = "SELECT * FROM $tableName ORDER BY (SELECT NULL) OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
    }

    if (!empty($whereClause)) {
        $query .= " WHERE $whereClause";
    }

    $stmt = $conn->query($query);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ob_start();
    if (count($data) > 0) {
        $currentPage = ($limit === 0) ? 1 : (int)($offset / $limit) + 1;
        $totalPages = ($limit === 0) ? 1 : ceil($totalCount / max($limit, 1));

        echo "<div class='mb-4 text-gray-700 text-lg text-center'>
                <strong>Total Records:</strong> $totalCount | 
                <strong>Showing:</strong> " . count($data) . " | 
                <strong>Page:</strong> $currentPage of $totalPages
              </div>";

        echo "<table class='w-full border-collapse shadow-md mt-4'>";
        echo "<tr class='bg-blue-500 text-white font-bold'>";
        foreach (array_keys($data[0]) as $column) echo "<th class='border px-4 py-2'>$column</th>";
        echo "</tr>";
        foreach ($data as $row) {
            echo "<tr class='bg-gray-100'>";
            foreach ($row as $value) echo "<td class='border px-4 py-2'>$value</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Dynamic pagination buttons
        if ($limit !== 0) {
            echo "<div class='flex justify-center space-x-4 mt-4'>";
            if ($currentPage > 1) {
                echo "<button onclick='fetchPage(" . ($offset - $limit) . ")' class='bg-gray-500 text-white px-4 py-2 rounded-lg'>Previous</button>";
            }
            if ($currentPage < $totalPages) {
                echo "<button onclick='fetchPage(" . ($offset + $limit) . ")' class='bg-gray-500 text-white px-4 py-2 rounded-lg'>Next</button>";
            }
            echo "</div>";
        }
    } else {
        echo "<p class='text-gray-500 text-center mt-4'>No records found.</p>";
    }

    echo json_encode(['status' => 'OK', 'html' => ob_get_clean()]);
} catch (PDOException $exception) {
    echo json_encode(['status' => 'ERR', 'msg' => 'Database query failed', 'details' => $exception->getMessage()]);
}
