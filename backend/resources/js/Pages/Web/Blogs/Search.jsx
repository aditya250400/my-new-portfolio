import BlogCard from "@/Components/BlogCard";
import SearchBlog from "@/Components/SearchBlog";
import MasterLayour from "@/Pages/Layout/MasterLayout";

export default function Search(props) {
    const { blogs, keyword } = props.page_data;

    return (
        <>
            <section
                id="blog"
                className="pt-36  bg-slate-200 dark:bg-slate-800"
            >
                <div className="max-w-screen-2xl mx-auto">
                    <div className="">
                        <div className="w-full p-4 flex justify-start ">
                            <h2 className="font-bold text-dark text-xl lg:text-3xl  dark:text-white">
                                Menampilkan pencarian: {keyword}
                            </h2>
                        </div>
                    </div>

                    <div className="flex flex-wrap mt-3">
                        {blogs.map((blog, index) => (
                            <BlogCard item={blog} key={index} />
                        ))}
                    </div>
                </div>
            </section>
        </>
    );
}

Search.layout = (page) => <MasterLayour children={page} />;
