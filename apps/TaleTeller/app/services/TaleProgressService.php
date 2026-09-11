<?php

require_once BASE_PATH . '/app/Repositories/MetaReader.php';
require_once BASE_PATH . '/app/Repositories/MetaWriter.php';
require_once BASE_PATH . '/app/Repositories/FragmentReader.php';
require_once BASE_PATH . '/app/Repositories/FragmentWriter.php';

class TaleProgressService
{
    private MetaReader $metaReader;
    private MetaWriter $metaWriter;
    private FragmentReader $fragmentReader;
    private FragmentWriter $fragmentWriter;

    public function __construct()
    {
        $this->metaReader = new MetaReader();
        $this->metaWriter = new MetaWriter();
        $this->fragmentReader = new FragmentReader();
        $this->fragmentWriter = new FragmentWriter();
    }

    public function addFragment(array $data): void
    {
        $meta = $this->metaReader->findById($data['tale_id']);
        // TALE EXISTS??
        if (!$meta) { throw new RuntimeException('Tale not found!'); }
        // IS FINISHED?
        if ($this->metaReader->isFinished($data['tale_id'])) { throw new RuntimeException('Tale is already finished!'); }
        // USER HAS COLLABORATED??
        if ($this->fragmentReader->hasCollaborated($data['tale_id'], $data['author'])) { throw new RuntimeException('User has already collaborated in this tale...'); }

        //NEXT STEP
        $currentStep = (int) $meta['current_step'];
        $totalSteps = (int) $meta['steps'];
        $nextStep = $currentStep + 1;

        // INSERT FRAG
        $this->fragmentWriter->create([
            'tale_id' => $data['tale_id'],
            'author' => $data['author'],
            'fragment' => $data['fragment'],
            'step_number' => $nextStep
        ]);

        // ACTUALIZE PROGRESS
        if ($nextStep >= $totalSteps) { $this->metaWriter->markAsFinished($data['tale_id']); }
        else { $this->metaWriter->updateCurrentStep($data['tale_id'], $nextStep); }
    }

    public function validateCollaboration(int $taleId, int $userId): void
    {
        $meta = $this->metaReader->findById($taleId);
        if (!$meta) { throw new RuntimeException('Tale not found!'); }
        if ($this->metaReader->isFinished($taleId)) { throw new RuntimeException('Tale is already finished!'); }
        if ($this->fragmentReader->hasCollaborated($taleId, $userId)) { throw new RuntimeException('You have already collaborated in this tale.'); }
    }
}
