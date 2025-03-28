import { TypographyH1 } from "@/Components/UI/typography";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Vn30Stocks from "@/Pages/Company/Vn30Stocks";
import { Head } from "@inertiajs/react";
import { ChangeEvent, useEffect, useState } from "react";
import InputComponent from "./SearchSymbol";
export default function FinancialReports({
  companies,
}: {
  companies: CompanyInfo[];
}) {
  const [sourceType, setSourceType] = useState<boolean>(true);
  const handleHandmade = () => {
    setSourceType(true);
  };
  const handleSource = () => {
    setSourceType(false);
  };
  const [stockCode, setStockCode] = useState("");
  const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
    setStockCode(event.target.value);
  };

  const [dataVN30, setDataVN30] = useState(companies);
  useEffect(() => {
    setDataVN30(companies);
  }, [companies]);

  const [filteredSymbols, setFilteredSymbols] = useState<string[]>([]);
  const handleSymbolsFiltered = (symbols: string[]) => {
    setFilteredSymbols(symbols);
  };
  return (
    <AuthenticatedLayout header={true}>
      <Head title="Company" />
      <div className="py-5">
        <div className="mx-auto sm:px-6 lg:px-8 max-w-7xl">
          <div className="flex flex-col">
            <div className="flex justify-between items-center mb-6 py-3">
              <TypographyH1>Danh sách Công ty</TypographyH1>
              <div className="relative flex items-center shadow-md mx-2 py-1 rounded-md w-fit h-fit">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth={2}
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="left-3 absolute text-text-Content"
                >
                  <circle cx="11" cy="11" r="8" />
                  <path d="m21 21-4.3-4.3" />
                </svg>

                <InputComponent
                  companies={companies}
                  onSymbolsFiltered={handleSymbolsFiltered}
                />
              </div>
            </div>

            {/* <div className="flex justify-between items-center"> */}
            {/* <div id="tool" className="flex border-0 shadow-md p-2 rounded-md"> */}
            {/* === OLD SEARCH INPUT PLACING POSITION */}
            {/* === UPDATE DATE BUTTON */}
            {/* <div
                  id="date"
                  className="flex flex-1 justify-center items-center mx-2 rounded ms-12"
                >
                  <Select>
                    <SelectTrigger className="border-slate-300 w-[180px] text-text-Content">
                      <SelectValue placeholder="Ngày cập nhập" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectGroup>
                        <SelectLabel>Chọn ngày cập nhập</SelectLabel>
                        <SelectItem value="apple">Mới nhất</SelectItem>
                        <SelectItem value="banana">1 năm trước</SelectItem>
                        <SelectItem value="blueberry"> 5 năm trước</SelectItem>
                      </SelectGroup>
                    </SelectContent>
                  </Select>
                </div> */}
            {/* === RESET BUTTON */}
            {/* <div
                  id="reset"
                  className="flex flex-1 justify-center items-center mx-2"
                >
                  <div className="flex items-center hover:bg-background-theme hover:shadow-md p-2 rounded transition-all duration-200 cursor-pointer">
                    <svg
                      className="text-text-link lucide lucide-rotate-ccw"
                      xmlns="http://www.w3.org/2000/svg"
                      width={15}
                      height={15}
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      strokeWidth={2}
                      strokeLinecap="round"
                      strokeLinejoin="round"
                    >
                      <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                      <path d="M3 3v5h5" />
                    </svg>
                    <span className="ml-1 text-sm text-text-link">
                      Đặt lại tất cả
                    </span>
                  </div>
                </div> */}
            {/* </div> */}

            {/* <AlertDialog>
                <AlertDialogTrigger asChild>
                  <AddButton asDiv>Thêm công ty</AddButton>
                </AlertDialogTrigger>
                <AlertDialogContent className="bg-background-active">
                  <AlertDialogHeader className="flex flex-col p-4">
                    <div className="flex space-x-2">
                      <div
                        onClick={handleHandmade}
                        className="text-sm text-text-Content hover:text-blue-500 transition-colors cursor-pointer"
                      >
                        Nguồn thủ công
                      </div>
                      <div className="text-text-Content">|</div>
                      <div
                        onClick={handleSource}
                        className="text-sm text-text-Content hover:text-blue-500 transition-colors cursor-pointer"
                      >
                        Tải từ nguồn cấp
                      </div>
                    </div>
                    {sourceType ? (
                      <AlertDialogTitle className="mt-2 text-text-Content">
                        - Lấy hồ sơ Thủ công
                      </AlertDialogTitle>
                    ) : (
                      <AlertDialogTitle className="mt-2 text-text-Content">
                        - Lấy hồ sơ công ty từ nguồn cấp
                      </AlertDialogTitle>
                    )}
                    <AlertDialogDescription className="text-sm">
                      {sourceType ? (
                        <>Đây là nội dung của thủ công</>
                      ) : (
                        <div className="border-white border rounded-[30px]">
                          <div className="border-white p-4 border-b">
                            <input
                              className="bg-transparent border-none focus:border-none w-full h-2 text-text-Content focus:outline-none focus:ring-0 text-sm"
                              type="text"
                              value={stockCode}
                              onChange={handleChange}
                              placeholder="Nhập mã cổ phiếu của công ty cần lấy ..."
                            />
                          </div>
                          <div id="listSearch" className="min-h-48">
                            <div className="flex justify-center items-center text-text-Content">
                              {stockCode.length > 0 ? (
                                <div className="flex flex-col p-5 w-full">
                                  <div className="border-neutral-400 mt-2 border rounded-xl">
                                    <div className="flex justify-between px-5 py-2">
                                      <h2 className="font-semibold">VNM</h2>
                                      <span className="bg-custom-button-success rounded-sm">
                                        <p className="px-5 text-sm">Đã có</p>
                                      </span>
                                    </div>
                                  </div>
                                  <div className="border-neutral-400 mt-2 border rounded-xl">
                                    <div className="flex justify-between px-5 py-2">
                                      <h2 className="font-semibold">VNM</h2>
                                      <span className="bg-custom-button-success rounded-sm">
                                        <p className="px-5 text-sm">Đã có</p>
                                      </span>
                                    </div>
                                  </div>
                                  <div className="border-neutral-400 mt-2 border rounded-xl">
                                    <div className="flex justify-between px-5 py-2">
                                      <h2 className="font-semibold">VNM</h2>
                                      <span className="bg-custom-button-success rounded-sm">
                                        <p className="px-5 text-sm">Đã có</p>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              ) : (
                                <span className="mt-16">
                                  Bạn chưa nhập mã cổ phiếu!
                                </span>
                              )}
                            </div>
                          </div>
                        </div>
                      )}
                    </AlertDialogDescription>
                  </AlertDialogHeader>
                  <AlertDialogFooter>
                    <AlertDialogCancel>Thoát</AlertDialogCancel>
                    <AlertDialogAction>Cập nhập</AlertDialogAction>
                  </AlertDialogFooter>
                </AlertDialogContent>
              </AlertDialog> */}
            {/* </div> */}

            <Vn30Stocks
              data={filteredSymbols.length > 0 ? filteredSymbols : dataVN30}
            />
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
