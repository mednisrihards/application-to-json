 <?php
    $fileName = 'archive.zip';
    $json = 'JSON/applications.json';
    $images = 'IMAGES/';
    $archive = new PharData($fileName);

    if (file_exists($json)) {
        $archive->buildFromDirectory($images);
        $archive->addFile($json);

        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
        header("Content-length: " . filesize($fileName));
        header("Pragma: no-cache");
        header("Expires: 0");
    
        ob_clean();
        flush();

        readfile($fileName);
        unlink($fileName);
        exit;

    } else {
        echo 'No applications are available';
    }