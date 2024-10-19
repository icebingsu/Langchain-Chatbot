import {
   Dialog,
   DialogContent,
   DialogDescription,
   DialogHeader,
   DialogTitle,
   DialogTrigger,
 } from "@/Components/UI/dialog"
const RemoveStaff = ()=>{
   return (
      <Dialog>
         <DialogTrigger className="flex items-center justify-center w-7 h-7 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition duration-200 ml-2">        
            <svg xmlns="http://www.w3.org/2000/svg" width={16} height={16} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2} strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-trash" > <path d="M3 6h18" /> <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" /> <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" /> </svg>
         </DialogTrigger>
         <DialogContent>
            <DialogHeader>
               <DialogTitle>Bạn có đồng ý xóa nhân viên này</DialogTitle>
               <DialogDescription>
                  sau khi xóa nhân viên này sẽ bị xóa khỏi danh sách vui lòng xác nhận
               </DialogDescription>
            </DialogHeader>
         </DialogContent>
      </Dialog>
   )
}
export default RemoveStaff
