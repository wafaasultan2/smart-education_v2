<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;

class TeacherList extends Component
{
    // عدد العناصر في كل صفحة
    public $perPage = 10;

    // متغير لتخزين نتائج البحث
    public $paginate;

    // متغير لتخزين نص البحث
    public $search = '';

    // تخزين قائمة المعلمين
    public $teachers;

    // الاستماع للحدث "teacherCreated" لإضافة معلم جديد
    protected $listeners = ['teacherCreated' => 'addTeacher'];

    // تهيئة البيانات عند تحميل المكون
    public function mount()
    {
        // تعديل البحث ليشمل التصفية بناءً على الجامعة
        $this->initPaginate($this->search());
    }

    // إضافة معلم جديد للقائمة
    public function addTeacher($teacher_id)
    {
        array_unshift($this->teachers, Teacher::find($teacher_id));
    }

    // الانتقال إلى صفحة معينة
    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }

    // عملية البحث (يتم تنفيذها أثناء التصفية)
    private function search($page = 1)
    {
        $query = Teacher::query();

        // تصفية المعلمين حسب الاسم أو اسم الجامعة إذا تم إدخال نص في البحث
        if ($this->search && !empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('university_name', 'like', '%' . $this->search . '%');
        }

        // إعادة نتائج البحث مع التصفية والتقسيم إلى صفحات
        return $query->paginate($this->perPage, ['*'], 'page', $page ?? 1);
    }

    // تهيئة خاصية التصفح حسب الصفحات
    private function initPaginate($paginate)
    {
        // تهيئة البيانات الخاصة بالتصفح
        $this->paginate = (object)[
            'firstItem' => $paginate->firstItem(),
            'lastItem' => $paginate->lastItem(),
            'total' => $paginate->total(),
            'lastPage' => $paginate->lastPage(),
            'hasMorePages' => $paginate->hasMorePages(),
            'currentPage' => $paginate->currentPage(),
            'getPageName' => $paginate->getPageName(),
            'onFirstPage' => $paginate->onFirstPage(),
            'pages' => $this->generatePagination($paginate)
        ];

        // تخزين المعلمين في المتغير teachers
        $this->teachers = $paginate->items();
    }

    // إنشاء أرقام الصفحات للتصفح
    private function generatePagination($paginate)
    {
        $currentPage = $paginate->currentPage();
        $lastPage = $paginate->lastPage();

        // تعيين عدد الصفحات التي ستظهر على اليمين واليسار
        $startPages = 3;
        $endPages = 3;
        $nearbyPages = 1;

        $pages = [];

        // إضافة الصفحات من البداية
        for ($i = 1; $i <= min($startPages, $lastPage); $i++) {
            $pages[] = $i;
        }

        // إضافة الفواصل عند الحاجة
        if ($currentPage > $startPages + $nearbyPages + 1) {
            $pages[] = '...';
        }

        // تحديد الصفحات القريبة من الصفحة الحالية
        $startNearby = max($currentPage - $nearbyPages, $startPages + 1);
        $endNearby = min($currentPage + $nearbyPages, $lastPage - $endPages);

        // إضافة الصفحات القريبة من الصفحة الحالية
        for ($i = $startNearby; $i <= $endNearby; $i++) {
            if (!in_array($i, $pages))
                $pages[] = $i;
        }

        // إضافة الفواصل إذا كانت هناك صفحات بعيدة
        if ($currentPage < $lastPage - $endPages - $nearbyPages) {
            $pages[] = '...';
        }

        // إضافة الصفحات من النهاية
        if ($lastPage - $endPages + 1 !== 0) {
            for ($i = $lastPage - $endPages + 1; $i <= $lastPage; $i++) {
                if (!in_array($i, $pages))
                    $pages[] = $i;
            }
        }

        return $pages;
    }

    // دالة لعرض البيانات في الواجهة
    public function render()
    {
        // تحديث العرض ليكون متوافقًا مع "الجامعة"
        return view('livewire.teacher.teacher-list');
    }
}
