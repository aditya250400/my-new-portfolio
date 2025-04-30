import { useForm } from "@inertiajs/react";

export default function SearchBlog() {
    const { data, setData, get } = useForm({
        keyword: "",
    });

    const onHandleChange = (e) => {
        setData({
            ...data,
            [e.target.name]: e.target.value,
        });
    };

    const onSubmit = (e) => {
        e.preventDefault();
        get(route("front.blogs.search"));
    };
    return (
        <>
            <div className="">
                <form
                    onSubmit={onSubmit}
                    className="w-[195px] lg:w-[300px] flex items-center rounded-full border border-slate-600 dark:border-slate-400 focus-within:border-none p-12px gap-[10px] focus-within:ring-2 focus-within:ring-primary transition-all duration-300 mx-6 lg:mx-0"
                    // className="flex items-center rounded-full border border-slate-600 p-[12px_20px] gap-[10px] focus-within:ring-2 focus-within:ring-[#FF6B18] transition-all duration-300"
                >
                    <label
                        className="w-5 h-5 flex shrink-0 ml-2.5 lg:ml-5 hover:cursor-pointer"
                        htmlFor="keyword"
                    >
                        <img src="/img/icons/search-normal.svg" alt="icon" />
                    </label>
                    <input
                        type="text"
                        name="keyword"
                        onChange={onHandleChange}
                        value={data.keyword}
                        id="keyword"
                        className="appearance-none ring-0 border-none outline-none w-full font-semibold placeholder:font-normal focus:ring-0 focus:outline-none placeholder:text-[#A3A6AE] bg-transparent px-0"
                        placeholder="Search articles..."
                        required
                    />
                </form>
            </div>
        </>
    );
}
