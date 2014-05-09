<?php

namespace App\Presenters;

use App\Model\Entity\Launchpad\Candidates\CandidateEntity;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

    /**
     * @inject App\Model\Launchpad\LaunchpadApi
     * @var App\Model\Launchpad\LaunchpadApi
     */
    public $launchpad;

    public function actionDefault()
    {
        $launchpad = $this->launchpad;

        $interviewID = "5435";
        $questionID = "6325";
        $candidateId = "2297";
        $accountId = "723";
        $candidateTomas = "cnd_8f44161772931aeed6c6bca9dc2a87e1";
        $candidatePetr = "cnd_ad879430edfa2b6ef14e021a90c86db2";

        $candidate = new CandidateEntity;
        $candidate->email = "pupe.dupe+launchpad1@gmail.com";
        $candidate->customCandidateId = "10";
        $candidate->firstName = "Petr";
        $candidate->lastName = "Poupě";

        // get API candidate
        if ($candidate->candidateId !== NULL) {
            $apiCandidate = $launchpad->getCandidate($candidate->candidateId);
        } else {
            $apiCandidate = $launchpad->setCandidate($candidate);
        }
//        \Nette\Diagnostics\Debugger::barDump($apiCandidate);
        // get API Interviews list
        $interviews = $launchpad->getInterviews();
//        \Nette\Diagnostics\Debugger::barDump($interviews, "interviews list");
        $this->template->interviewsCount = count($interviews);

        // get API Interview
        $interview = $launchpad->getInterview($interviewID);
//        \Nette\Diagnostics\Debugger::barDump($interview, "interview ID:{$interviewID}");
        $this->template->interview = $interview;

        // get API Interview Link
        $interviewLink = $launchpad->getInterviewLink($interviewID);
        $this->template->interviewLink = $interviewLink;


        $selectedCandidate = $apiCandidate->candidateId;
//        $selectedCandidate = $candidateTomas;
        $reviewInterview = $launchpad->getReviewInterviewLink($interviewID, $selectedCandidate);
        $this->template->reviewInterview = $reviewInterview;

        $inviteLink = $launchpad->getInviteLink($interviewID, $selectedCandidate);
//        \Nette\Diagnostics\Debugger::barDump($inviteLink);
        $this->template->inviteLink = $inviteLink;
    }

    public function renderDefault()
    {
        
    }

}
