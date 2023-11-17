<?php

namespace App\Imports\HoldPaymentMerchant;

use App\Models\HoldPaymentMerchant\NonBniModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NonBniReleaseImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithEvents, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        date_default_timezone_set("Asia/Jakarta");
        foreach ($rows as $row) {
            $data = NonBniModel::where('id', $row['id'])
            ->update([
                'cust_name_release' => $row['cust_name_release'],
                'act_release' => $row['act_release'],
                'tanggal_reproses_payment' => $this->transformDate($row['tanggal_reproses_payment']),
                'status' => 'CLOSED-DONE',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function rules(): array
    {
        return [
             // Can also use callback validation rules
             '*.matchingkey' => ['required', Rule::exists('non_bni', 'matchingkey')],
             '*.cust_name_release' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('Kolom CUST NAME RELEASE Kosong');
                }
              }, 
              '*.act_release' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('Kolom ACT RELEASE Kosong');
                }
            },
            '*.tanggal_reproses_payment' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('Kolom TANGGAL REPROSES PAYMENT Kosong');
                }
            },
            '*.id' => function($attribute, $parameters, $onFailure) {
                $nonBni = NonBniModel::find($parameters);
                if ($nonBni->status == 'CLOSED-DONE') {
                    $onFailure('Data Sudah Pernah Di Release Tanggal '.$bni->tanggal_reproses_payment);
                }
            }
        ];
    }
}
