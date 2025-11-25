<footer class="site-footer">
    <style>
        :root {
            --footer-bg: #f8fafc;
            --footer-border: #e2e8f0;
            --footer-text: #64748b;
            --footer-accent: #2563eb;
            --footer-shadow: rgba(0, 0, 0, 0.05);
        }

        .site-footer {
            background: var(--footer-bg);
            border-top: 1px solid var(--footer-border);
            padding: 20px 0;
            margin-top: 30px;
            font-size: 14px;
            color: var(--footer-text);
        }

        .footer-content {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-text {
            margin: 0;
            font-weight: 500;
            text-align: left;
        }

        .footer-links {
            display: flex;
            gap: 20px;
            margin-left: 100px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .footer-links a {
            color: var(--footer-text);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .footer-links a:hover {
            color: var(--footer-accent);
            text-decoration: underline;
        }

        .go-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--footer-accent), #1e40af);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
        }

        .go-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .go-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
        }

        .go-top i {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .site-footer {
                padding: 15px 0;
            }

            .footer-content {
                padding: 0 15px;
                flex-direction: column;
                text-align: center;
            }
            
            .footer-text {
                text-align: center;
                margin-top: 15px;
            }
            
            .footer-links {
                justify-content: center;
            }

            .footer-links {
                gap: 15px;
            }
        }
    </style>

    <div class="footer-content">
        <div class="footer-links">
            <a href="#"><i class="fa fa-shield"></i> Privacy Policy</a>
            <a href="#"><i class="fa fa-file-text"></i> Terms of Service</a>
            <a href="#"><i class="fa fa-question-circle"></i> Help Center</a>
            <a href="#"><i class="fa fa-envelope"></i> Contact Us</a>
        </div>
        <div class="footer-text">
            &copy; 2025 ResolveX. All rights reserved.
        </div>
    </div>

    <a href="#" class="go-top" id="goTop">
        <i class="fa fa-angle-up"></i>
    </a>

    <script>
        // Show/hide scroll to top button
        window.addEventListener('scroll', function () {
            var goTop = document.getElementById('goTop');
            if (window.pageYOffset > 300) {
                goTop.classList.add('visible');
            } else {
                goTop.classList.remove('visible');
            }
        });

        // Smooth scroll to top
        document.getElementById('goTop').addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</footer>