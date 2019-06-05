<?php
namespace App\Controller;


use App\Entity\DayPart;
use App\Entity\DayPartStatus;
use App\Entity\WorkingDay;
use App\Repository\DaypartRepository;
use App\Repository\DaypartstatusRepository;
use App\Repository\DayparttypeRepository;
use App\Repository\WorkingdayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calendar", host="admin.renaissance-terrehappy.fr")
 */
class CalendarController extends AbstractController
{
    private $dayPartTypeRepository;
    private $dayPartStatusRepository;
    public function __construct(
        DayparttypeRepository $dayPartTypeRepository,
        DaypartstatusRepository $dayPartStatusRepository
    )
    {
        $this->dayPartTypeRepository = $dayPartTypeRepository;
        $this->dayPartStatusRepository = $dayPartStatusRepository;
    }

    /**
     * @Route("/", name="calendar_index", methods={"GET", "POST"})
     */
    public function index(Request $request, WorkingdayRepository $workingDayRepository): Response
    {

        if ($request->getMethod() == "POST")
        {
            $daysToCreate = $request->get('days');
            foreach ($daysToCreate as $date) {

                $this->createWorkingDay($date, $workingDayRepository);
            }
        }

        $workingDays = $workingDayRepository->findAll();
        $events = [];
        foreach ($workingDays as $workingDay)
        {
            $date = $workingDay->getDayyear()."-".$workingDay->getDaymonth()."-".$workingDay->getDaydate();
            $parts = $workingDay->getDayparts();
            foreach ($parts as $dayPart)
            {
                $title = $dayPart->getType()->getDefinition();
                $title .= $dayPart->getUser()? ": ".$dayPart->getUser()->getUsername():'';
                $event = array(
                    "id" => $dayPart->getId(),
                    "workingDay" => $workingDay->getId(),
                    "start" =>  $date,
                    "status" => $dayPart->getStatus()->getValue(),
                    "classNames" => ["status-".$dayPart->getStatus()->getValue()],
                    "title" => $title
                );
                array_push($events, $event);
            }
        }


        return $this->render('calendar/index.html.twig', array(
            'events' => $events,
            'mainNavCalendar'=> true
        ));
    }

    private function createWorkingDay($date, WorkingdayRepository $workingDayRepository)
    {
        $dateSplitted = explode("-",$date);
        $dateYear = $dateSplitted[0];
        $dateMonth = $dateSplitted[1];
        $dateDate = $dateSplitted[2];

        $exists = $workingDayRepository->findBy(array(
            "dayyear" => $dateYear,
            "daymonth" => $dateMonth,
            "daydate" => $dateDate
        ));

        if (count($exists) === 0){
            $workingDay = new Workingday();
            $workingDay->setDaydate($dateDate);
            $workingDay->setDaymonth($dateMonth);
            $workingDay->setDayyear($dateYear);

            $em = $this->getDoctrine()->getManager();
            $em->persist($workingDay);

            $this->createDayParts($workingDay);
            $em->flush();
        }
    }

    private function createDayParts(Workingday $workingDay)
    {
        $statusFree = $this->dayPartStatusRepository->findOneBy(array("value"=>Daypartstatus::FREE));
        for ($i = 0; $i < 4; $i++)
        {
            $part = new Daypart();
            $type = $this->dayPartTypeRepository->findOneBy(array("value"=>($i+1)));
            $part->setWorkingday($workingDay);
            $part->setStatus($statusFree);
            $part->setType($type);
            $workingDay->addDaypart($part);
        }
    }
}