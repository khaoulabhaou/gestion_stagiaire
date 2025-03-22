<!-- public function archive()
{
    // Fetch stagiaires whose stages have ended
    $archivedStagiaires = Stagiaire::with(['service', 'etablissement'])
        ->archived()
        ->get();

    // Move archived stagiaires to the archive table
    foreach ($archivedStagiaires as $stagiaire) {
        ArchivedStagiaire::create($stagiaire->toArray());
        $stagiaire->delete(); // Optionally delete from the main table
    }

    return view('stagiaires.archive', compact('archivedStagiaires'));
} -->