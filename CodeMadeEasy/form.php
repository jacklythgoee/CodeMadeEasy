<?php

declare(strict_types=1);

function validateFormData(
    string $contact_name,
    string $contact_email,
    string $contact_subject,
    string $contact_message
): array {
    $errors = [];

    // Insert some validation here. I added customer_name and customer_email required as example

    return $errors;
}

function getFormData(PDO $db, int $page=0): Generator
{
    --$page;        // Subtract one to start with 0
    if ($page < 0) {
        $page = 0;
    }
    $startLimit = $page * 10;
    $sql = sprintf('SELECT * FROM `contact` ORDER BY `id` DESC LIMIT %d, 10', $startLimit);
    $stmt = $db->query($sql);
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        yield $row;  // Return the result directly, which is better for memory usage.
    }
}

function getFormPages(PDO $db): int                             //Gatheting form data
{
    $sql = 'SELECT count(*) AS c FROM `contact`';
    $stmt = $db->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int) ceil((int) $result['c'] / 10);
}

function getFormById(PDO $db, int $id): array                   //Gatheting form data
{
    $sql = 'SELECT * FROM `contact` WHERE `id` = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);

    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($record === false) {
        throw new RuntimeException('record not found');
    }

    return $record;
}

/**
 * @throws PDOException
 */
function updateFormById(                //Updating form and inserting into MySQL db
    PDO $db,
    int $id,
    string $contact_name,
    string $contact_email,
    string $contact_subject,
    string $contact_message

): void {
    $sql = 'UPDATE `contact` SET  `contact_name` = :contact_name, `contact_email` = :contact_email,  `contact_subject` = :contact_subject,  `contact_message` = :contact_message WHERE `id` = :id';
    $stmt = $db->prepare($sql);
    try {
        $db->beginTransaction();
        $stmt->execute([
            ':id' => $id,
            ':contact_name' => $contact_name,
            ':contact_email' => $contact_email,
            ':contact_subject' => $contact_subject,
            ':contact_message' => $contact_message
        ]);
        $db->commit();
    } catch (PDOException $exception) {
        $db->rollBack();
        throw $exception;
    }
}

/**
 * @throws PDOException
 */
function deleteFormById(PDO $db, int $id): void                 // Deleting form from MySQL
{
    $sql = 'DELETE FROM `contact` WHERE `id` = :id';
    $stmt = $db->prepare($sql);
    try {
        $db->beginTransaction();
        $stmt->execute([':id' => $id]);
        $db->commit();
    } catch (PDOException $exception){
        $db->rollBack();
        throw $exception;
    }
}

/**
 * @throws PDOException
 */
function createForm(                    // Create Form function and insert into MySQL
    PDO $db,
    string $contact_name,
    string $contact_email,
    string $contact_subject,
    string $contact_message
): int {
    $sql = 'INSERT INTO `contact` (`contact_name`, `contact_email`, `contact_subject`, `contact_message`) 
                                  VALUES (:contact_name, :contact_email, :contact_subject, :contact_message)';
    $stmt = $db->prepare($sql);

    try {
        $db->beginTransaction();
        $stmt->execute([
           ':contact_name' => $contact_name,
           ':contact_email' => $contact_email,
           ':contact_subject' => $contact_subject,
           ':contact_message' => $contact_message
       ]);
        $db->commit();
        return (int)$db->lastInsertId();
    } catch (PDOException $exception) {
        $db->rollBack();
        throw $exception;
    }
}
